<!DOCTYPE html>
<html>
<head>
	<title>List of Events</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
					<a class="nav-link" href="{{ route('login') }}">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('register-user') }}">Register</a>
				</li>
				<li class="nav-item active">
                    <a class="nav-link" href="{{ route('pre-events') }}">List of Events</a>
                </li>
				@else
				<li class="nav-item">
					<a class="nav-link" href="{{ route('addevents') }}">Add Events</a>
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
				@if(session('success'))
                    <div class="alert alert-success closed" role="alert">
                      {{session('success')}}
                    </div>
                @endif
				<div class="card">		
					<h3 class="card-header text-center">List of Events</h3>
					<div class="card-body">
						<form action="{{ route('events.search') }}" method="POST">
							@csrf
							<div class="form-group mb-3">
								<div class="row g-3">
								  <div class="col">
								  	<label><strong>Event Name</strong></label>
								    <input type="text" class="form-control" placeholder="Event name" aria-label="Event name" name="event_name" value="{{request('event_name')}}">
								  </div>
								  <div class="col">
								  	<label><strong>Start Date</strong></label>
								    <input type="text" class="form-control" placeholder="Start Date" aria-label="Start Date" name="start_date" value="{{request('start_date')}}" onfocus="(this.type='date')">
								  </div>
								  <div class="col">
								  	<label><strong>End Date</strong></label>
								    <input type="text" class="form-control" placeholder="End Date" aria-label="End Date" name="end_date" value="{{request('end_date')}}" onfocus="(this.type='date')">
								  </div>
								</div>
							</div>
							<div class="form-group mb-3">
								<div class="col-md-2">
									<button type="submit" class="btn btn-dark btn-block">Search</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<br>
				<?php if(count($datalist) !=0 && !empty($datalist)){ ?>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="thead-dark">
								<th scope="col">S.no</th>
								<th scope="col">Event Name</th>
								<th scope="col">Start Date</th>
								<th scope="col">End Date</th>
								<!-- <th scope="col">Status</th> -->
							</thead>
							<tbody>
								<?php  if(!empty($_REQUEST['page']) && $_REQUEST['page'] != 1) $sn = ($_REQUEST['page'] * 5) + 1; else $sn = 1; ?>
							    @foreach($datalist as $key => $events)
							    	
							        <tr>
							            <td>{{ $sn++ }}</td>
							            <td>{{ $events->event_name }}</td>
							            <td>{{ $events->start_date }}</td>
							            <td>{{ $events->end_date }}</td>
							            <!-- <td>@if( $events->status == 1) Active @else Inactive @endif</td> -->
							        </tr>
							        
							    @endforeach
							</tbody>
						</table>
					</div>
					<div class="d-felx justify-content-center">
						{{ $datalist->links() }}
					</div>
				<?php } else {
					echo 'No records found';
				}?>
			</div>
		</div>
	</div>
</main>
<script type="text/javascript">
    $(function(){
        setTimeout(function(){
            $('.closed').hide();
        }, 3000);
    });
</script>
</body>
</html>