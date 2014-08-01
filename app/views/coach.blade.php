@extends('main')

@section('title')
	Life Coach, Inc.
@stop

@section('body')
	<div class="jumbotron">
		<div class="container theme-showcase" role="main">
			{{-- Clickable image to bring users back to this page --}}
			<!-- <a href='/'>{{ HTML::image('/images/p3.png', 'Site Logo'); }}</a> -->
			<h1>Life Coach, Inc.</h1>

			<blockquote>Welcome back coach!  What would you like to do today?</blockquote>
		</div>
	</div>
	<div class="container">
	<h2 id="tables-example">Tasks</h2>
		<table class="table table-condensed">
			<tr>
				<th>Title</th>
				<th>Description</th>
				<th>Due Date</th>
				<th>Completed</th>
			</tr>
			<?php $tasks = Task::all(); ?>
			@foreach ($tasks as $task)
			<tr>
				<td>{{$task->title}}</td>
				<td>{{$task->description}}</td>
				<td>{{$task->duedate}}</td>
				<td>{{$task->completed}}</td>
			</tr>
			@endforeach
		</table>
	</div>
	<div class="container">
	<h2 id="tables-example">Clients</h2>
		<table class="table table-condensed">
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Username</th>
			</tr>
			<?php $clients = User::where('usertype', '=', 'client')->get(); ?>
			@foreach ($clients as $client)
			<tr>
				<td>{{$client->firstname}}</td>
				<td>{{$client->lastname}}</td>
				<td>{{$client->email}}</td>
				<td>{{$client->username}}</td>
			</tr>
			@endforeach
		</table>

	</div>
@stop
