@extends('main')

@section('title')
	Life Coach, Inc.
@stop

@section('body')
	<div class="container">
	<!-- /app/views/signup.blade.php -->
	<div class="jumbotron">
		<h1>Log in</h1>

		{{ Form::open(array('url' => '/login')) }}

		Username<br>	
		{{ Form::text('username') }}<br><br>

		Password:<br>
		{{ Form::password('password') }}<br><br>

		{{ Form::submit('Submit') }}

		{{ Form::close() }}
	</div>
	</div>
	@if(Session::get('flash_message'))
        <div class='flash-message'>{{ Session::get('flash_message') }}</div>
    @endif

@stop
