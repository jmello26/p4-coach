@extends('main')

@section('title')
	Life Coach, Inc.
@stop

@section('jumbo')
			<blockquote>Welcome back {{Auth::user()->firstname}}!  What would you like to do today?</blockquote>
			<a class="btn btn-primary" href="/assign">Assign Tasks to Clients</a>
@stop

@section('body')
	<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 id="tables-tasks">Task Library</h3>
			<table class="table table-condensed">
				<tr>
					<th>Title</th>
					<th>Description</th>
					<th>File</th>
				</tr>
				<?php $tasks = Task::all(); ?>
				@foreach ($tasks as $task)
				<tr>
					<td>{{$task->title}}</td>
					<td>{{$task->description}}</td>
					<td><a href='/file/{{$task->id}}'>{{$task->filename}}</a></td>
				</tr>
				@endforeach
			</table>
			<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#taskModal">+ Add Task</button>
		</div>
	</div>
	</div>
	
	
	<div class="container">
		<div class="panel panel-default">
		<div class="panel-body">
			<h3 id="tables-clients">Clients</h3>
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
		<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#clientModal">+ Add Client</button>
		</div>
	</div>
	</div>
	<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="Add Client" aria-hidden="true">
		<div class="modal-dialog">
		{{ Form::open(array('url' => '/coach/client')) }}
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Add Client</h4>
				</div>
				<div class="modal-body">
					First Name<br>	
					{{ Form::text('firstname') }}<br><br>

					Last Name<br>	
					{{ Form::text('lastname') }}<br><br>

					Email<br>	
					{{ Form::email('email') }}<br><br>

					Username<br>	
					{{ Form::text('username') }}<br><br>

					Password:<br>
					{{ Form::password('password') }}<br><br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
				</div>
			</div><!-- /.modal-content -->
		{{ Form::close() }}
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="Add Task" aria-hidden="true">
		<div class="modal-dialog">
		{{ Form::open(array('url' => '/coach/task','files' => true)) }}
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Add Task</h4>
				</div>
				<div class="modal-body">
					Title<br>
					{{ Form::text('title') }}<br><br>

					Description<br>
					{{ Form::textarea('description') }}<br><br>

					File<br>
					{{ Form::file('file') }}<br><br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
				</div>
			</div><!-- /.modal-content -->
		{{ Form::close() }}
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->



	
@stop
