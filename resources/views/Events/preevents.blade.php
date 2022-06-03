<!DOCTYPE html>
<html>
<head>
	<title>List of Events</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		@media (min-width: 992px){
			.navbar-expand-lg .navbar-collapse {
				display: contents!important;
				flex-basis: auto;
			}
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
		<div class="container">
			<a class="navbar-brand mr-auto" href="#">ATeam Soft Solution</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
			aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				@guest
				<li class="nav-item">
					<a class="nav-link" href="{{ route('pre-events') }}">List of Events</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('login') }}">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('register-user') }}">Register</a>
				</li>				
				@else
				<li class="nav-item">
					<a class="nav-link" href="{{ route('signout') }}">Logout</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('signout') }}">Logout</a>
				</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>
<main class="eventlist-form">
	<div class="cotainer">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="card">					
					<h3 class="card-header text-center">Latest 10 - List of Events</h3>					
				</div>
				<br>
				<?php if(count($datalist) !=0 && !empty($datalist)){ ?>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="thead-dark">
								<th scope="col">S.no</th>
								<th scope="col">Event Name</th>
								<th scope="col">Start Date</th>
								<th scope="col">End Data</th>
								<th scope="col">Status</th>
							</thead>
							<tbody>
								<?php  $sn = 1; ?>
							    @foreach($datalist as $key => $events)
							    	
							        <tr>
							            <td>{{ $sn++ }}</td>
							            <td>{{ $events->event_name }}</td>
							            <td>{{ $events->start_date }}</td>
							            <td>{{ $events->end_date }}</td>
							            <td>@if( $events->status == 1) Active @else Inactive @endif</td>
							        </tr>
							        
							    @endforeach
							</tbody>
						</table>
					</div>
				<?php } else {
					echo 'No records found';
				}?>
			</div>
		</div>
	</div>
</main>
</body>
</html>