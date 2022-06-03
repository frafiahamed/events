<!DOCTYPE html>
<html>
<head>
	<title>Events Registration</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
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
				<li class="nav-item">
                    <a class="nav-link" href="{{ route('pre-events') }}">List of Events</a>
                </li>
				@else
				<li class="nav-item">
					<a class="nav-link" href="{{ route('signout') }}">Logout</a>
				</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>
<main class="signup-form">
	<div class="cotainer">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="card">					
					<h3 class="card-header text-center">Register User</h3>
					<div class="card-body">
						<form action="{{ route('register.custom') }}" method="POST">
							@csrf
							<div class="form-group mb-3">
								<label for="event_name">First Name:</label>
								<input type="text" placeholder="Enter Firstname" id="firstname" class="form-control" name="firstname"
								required autofocus>
								@if ($errors->has('firstname'))
								<span class="text-danger">{{ $errors->first('firstname') }}</span>
								@endif
							</div>
							<div class="form-group mb-3">
								<label for="event_name">Last Name:</label>
								<input type="text" placeholder="Enter Lastname" id="lastname" class="form-control" name="lastname"
								required autofocus>
								@if ($errors->has('lastname'))
								<span class="text-danger">{{ $errors->first('lastname') }}</span>
								@endif
							</div>
							<div class="form-group mb-3">
								<label for="event_name">Email ID:</label>
								<input type="text" placeholder="Enter your Email ID" id="email_address" class="form-control"
								name="email" required autofocus>
								@if ($errors->has('email'))
								<span class="text-danger">{{ $errors->first('email') }}</span>
								@endif
							</div>
							<div class="form-group mb-3">
								<label for="event_name">Password:</label>
								<input type="password" placeholder="Enter Your Strong Password" id="password" class="form-control"
								name="password" required>
								@if ($errors->has('password'))
								<span class="text-danger">{{ $errors->first('password') }}</span>
								@endif
							</div>
							<?php
								$today = new \DateTime();
								$minDate = $today->modify('-18 years');
							?>
							<div class="form-group mb-3">
								<label for="event_name">Date Of Birth:</label>
								<input type="date" placeholder="Enter your Email ID" id="dob" class="form-control"
								name="dob" required min="<?php echo $minDate->format('Y-m-d'); ?> ">
								@if ($errors->has('dob'))
								<span class="text-danger">{{ $errors->first('dob') }}</span>
								@endif
							</div>
							<div class="form-group mb-3">
								<label for="event_name">Gender:</label>
								<input type="radio" name="gender" id="gender" value="M">Male
								<input type="radio" name="gender" id="gender" value="F">Female
								@if ($errors->has('gender'))
								<span class="text-danger">{{ $errors->first('gender') }}</span>
								@endif
							</div>
							<div class="form-group mb-3">
								<div class="checkbox">
									<label><input type="checkbox" name="remember"> Remember Me</label>
								</div>
							</div>
							<div class="d-grid mx-auto">
								<button type="submit" class="btn btn-dark btn-block">Sign up</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
</body>
</html>