<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Astropolish Inc - Technical Exam</title>

	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom_style.css') }}" rel="stylesheet">

	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/jquery.min.js') }}"></script>
</head>
<body>

	<div class="wrapper fadeInDown">
	  <div id="formContent">
	    <!-- Tabs Titles -->

	    @if(Session::has('login_msg'))
            <div class="alert alert-warning" role="alert">
			  {{ Session::get('login_msg') }}
			</div>
      	@endif

	    <!-- Title -->
	    <div class="fadeIn first login-header-text">
	      <h2>Astropolis, Inc. - Technical Exam</h2>
	    </div>

	    <!-- Login Form -->
	    <form id="login-form" method="POST" action="auth">
	      @csrf
	      <input type="email" id="email" class="fadeIn second" name="email" placeholder="Email" required>
	      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required>
	      <input type="submit" class="fadeIn fourth" value="Log In">
	    </form>

	  </div>
	</div>

</body>
</html>