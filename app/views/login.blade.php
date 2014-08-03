@extends('main')

@section('title')
	Life Coach, Inc.
@stop

@section('body')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-body">

	<!-- /app/views/signup.blade.php -->
			<h2>Log in</h2>

			{{ Form::open(array('url' => '/login')) }}

			Username<br>	
			{{ Form::text('username') }}<br><br>

			Password<br>
			{{ Form::password('password') }}<br><br>

			{{ Form::submit('Submit') }}

			{{ Form::close() }}
			</div>
		</div>
	</div>
@stop
