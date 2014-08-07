@extends('main')

@section('title')
	Life Coach, Inc.
@stop

@section('jumbo')
	<blockquote>Assign tasks to your clients.</blockquote>
@stop

@section('body')
	<div class="container">
		{{ Form::open(array('url' => '/coach/assign', 'class' => 'form-inline')) }}

		<div class="panel panel-default">
		<div class="panel-body">

			<?php 
			$clients = User::where('usertype', '=', 'client')->get(); 
			$client_array = array ();
			foreach ($clients as $client) {
				$client_array[$client->id] = $client->firstname." ".$client->lastname;
			}
			?>
			{{Form::label('client', 'Select a client');}}
			{{Form::select('client', $client_array, Session::get('client_id'), array('class' => 'form-control'));}}
			{{Form::submit('Select', array('class' => 'btn btn-primary'));}}
			
			<h3 id="table-assignments">Current Assignments</h3>
			<table class="table table-condensed">
				<tr>
					<th>Complete</th>
					<th>Due Date</th>
					<th>Title</th>
					<th>Description</th>
					<th>Attachment</th>
				</tr>
				<!-- Input::get('client') -->
				<?php $assignments = Assignment::where('user_id', '=', Session::get('client_id'))->get(); ?>
				@foreach ($assignments as $assignment)
				<tr>
					<td><?php if ($assignment->complete == 1) { echo "<span class='glyphicon glyphicon-ok'></span>";} ?></td>
					<td>{{$assignment->duedate}}</td>
					<td>{{$assignment->title}}</td>
					<td>{{$assignment->description}}</td>
					<td>{{$assignment->filename}}</td>
				</tr>
				@endforeach
			</table>
		</div>
		</div>
		
		<div class="panel panel-default">
		<div class="panel-body">
			
		<h3 id="table-tasks">Available Tasks</h3>

			<table class="table table-condensed">
				<tr>
					<th>Select</th>
					<th>Title</th>
					<th>Description</th>
					<th>Due Date</th>
				</tr>
				<?php $tasks = Task::all(); ?>
				@foreach ($tasks as $task)
				<tr>
					<td>{{Form::checkbox('task_id'.$task->id, $task->id);}}</td>
					<td>{{$task->title}}</td>
					<td>{{$task->description}}</td>
					<td><input type="date" class="form-control" name="duedate{{$task->id}}" placeholder="Due date"></td>
				</tr>
				@endforeach
			</table>
			<p>Assign selected tasks to client: {{Form::submit('Assign', array('class' => 'btn btn-primary'));}} </p>
		{{ Form::close(); }}

		<br>		
		</div>
		</div>
	</div>
@stop
