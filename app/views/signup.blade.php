@extends('main')

@section('title')
	Life Coach, Inc.
@stop

@section('body')
	<div class="container">
	<!-- /app/views/signup.blade.php -->
		<h1>Sign up</h1>

		{{ Form::open(array('url' => '/signup')) }}

		Email<br>
		{{ Form::text('email') }}<br><br>

		Password:<br>
		{{ Form::password('password') }}<br><br>

		{{ Form::submit('Submit') }}

		{{ Form::close() }}
	</div>
@stop
