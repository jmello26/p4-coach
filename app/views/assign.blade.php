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
			{{Form::select('client', $client_array,'', array('class' => 'form-control'));}}
		</div>
		</div>
		
		<div class="panel panel-default">
		<div class="panel-body">
			
		<h2 id="table-tasks">Available Tasks</h2>

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
			{{Form::submit('Assign', array('class' => 'btn btn-primary'));}}

		<br>
<!--		<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#assignmentModal">Assign Tasks</button>		-->
		
		<h2 id="table-assignments">Current Assignments</h2>
		<table class="table table-condensed">
			<tr>
				<th>Completed</th>
				<th>Due Date</th>
				<th>Title</th>
				<th>Description</th>
				<th>Attachment</th>
			</tr>
			<?php $assignments = Assignment::where('user_id', '=', Input::old('client'))->get(); ?>
			@foreach ($assignments as $assignment)
			<tr>
				<td>{{$assignment->completed}}</td>
				<td>{{$assignment->duedate}}</td>
				<td>{{$assignment->title}}</td>
				<td>{{$assignment->description}}</td>
				<td>{{$assignment->filename}}</td>
			</tr>
			@endforeach
		</table>
		</div>
		</div>
		{{ Form::close(); }}
	</div>

		<div class="modal fade" id="assignmentModal" tabindex="-1" role="dialog" aria-labelledby="Assign Tasks" aria-hidden="true">
		<div class="modal-dialog">
		{{ Form::open(array('url' => '/coach/assign')) }}
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Assign Tasks</h4>
				</div>
				<div class="modal-body">
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

					<!--
					{{Form::hidden('client_id', Input::get('client'));}}
					Title<br>	
					{{ Form::text('title') }}<br><br>

					Description:<br>
					{{ Form::textarea('description') }}<br><br>
					File:<br>
					{{ Form::file('file') }}<br><br>
					-->
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
