<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Main document')</title>

    <!-- Bootstrap - ->
    <link href="css/bootstrap.min.css" rel="stylesheet"> -->
	<!-- Latest compiled and minified CSS -->
	
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	@yield('head')
  </head>
  <body>
	@yield('content')
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	    <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
			
			@if(Auth::check() && Auth::user()->usertype == 'coach')
				<li class="active"><a href="/coach">Admin</a></li>
			@elseif (Auth::check() && Auth::user()->usertype == 'client')
				<li class="active"><a href="/client">Tasks</a></li>
			@endif
          </ul>
          <ul class="nav navbar-nav navbar-right">
			@if(Auth::check())
				<li class="active"><a href='/logout'>Log out {{ Auth::user()->firstname; }} {{ Auth::user()->lastname; }}</a></li>
			@else 
				<li class="active"><a href='/login'>Log in</a></li>
			@endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
	</div>
	<div class="jumbotron">
		<div class="container theme-showcase" role="main">
		@if(Session::get('flash_message'))
		<div class="container">
			<div class='flash-message'>
				<p class="bg-warning">{{ Session::get('flash_message') }}</p>
			</div>
		</div>
		@endif
		<h1>Life Coach, Inc.</h1>
		@yield('jumbo')
		</div>
	</div>
	@yield('body')
	<!--
		<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			{{ Form::open(array('url' => '/login')) }}
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Log in</h4>
					</div>
					<div class="modal-body">
						Username<br>	
						{{ Form::text('username') }}<br><br>

						Password:<br>
						{{ Form::password('password') }}<br><br>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						{{ Form::submit('Log in', array('class' => 'btn btn-primary')) }}
					</div>
				</div><!-- /.modal-content - ->
			{{ Form::close() }}
			</div><!-- /.modal-dialog - ->
		</div><!-- /.modal - ->
	-->

	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
	<!-- Latest compiled and minified JavaScript -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

  </body>
</html>