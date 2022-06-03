<!DOCTYPE html>
<html>
<head>
	<title>Add Events</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
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
				@else
				<li class="nav-item">
					<a class="nav-link" href="{{ route('events-list') }}">List of Events</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('signout') }}">Logout</a>
				</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>
<main class="add-event-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Add Events</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('add.event') }}">
                            @csrf
                            <div class="form-group mb-3">
                            	<label for="event_name"><strong>Event Name</strong></label>
                                <input type="text" placeholder="Enter Event Name" id="event_name" class="form-control" name="event_name" required
                                autofocus>
                                @if ($errors->has('event_name'))
                                <span class="text-danger">{{ $errors->first('event_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                            	<label for="event_name"><strong>Start Date</strong></label>
                                <input type="text" placeholder="Start Date" id="start_date" class="form-control" name="start_date" required onfocus="(this.type='date')">
                                @if ($errors->has('start_date'))
                                <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                            	<label for="event_name"><strong>End Date</strong></label>
                                <input type="text" placeholder="End Date" id="end_date" class="form-control" name="end_date" required onfocus="(this.type='date')">
                                @if ($errors->has('end_date'))
                                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3 form-wrapper">
                            	<label for="event_name"><strong>Email ID</strong></label>
                            	<div>
	                                <input type="email" placeholder="Enter Email ID" class="form-control" name="email_id[]" required>
	                                <button class="add-button" title="Add field">Add</button>
	                            </div>
                                @if ($errors->has('email_id'))
                                <span class="text-danger">{{ $errors->first('email_id') }}</span>
                                @endif
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Create Event</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
<script>

	jQuery(document).ready(function(){
	    var maxLimit = 5;
	    var appendHTML = '<div><input type="email" placeholder="Enter Email ID" class="form-control" name="email_id[]" value="" required><button class="remove-button" title="Remove field">Remove</button></div>';

	    var x = 1;
	    
	    // for addition
	    jQuery('.add-button').click(function(e){
	    	e.preventDefault();
	        if(x < maxLimit){ 
	            jQuery('.form-wrapper').append(appendHTML);
	            x++;
	        }
	    });
	    
	    // for deletion
	    jQuery('.form-wrapper').on('click', '.remove-button', function(e){
	        e.preventDefault();
	        jQuery(this).parent('div').remove();
	        x--;
	    });
	});

</script>
</html>