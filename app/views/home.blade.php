@extends('main')

@section('title')
	Life Coach, Inc.
@stop

@section('jumbo')
	<blockquote>Welcome back {{Auth::user()->firstname}}!<br> Below are your current tasks.</blockquote>
@stop

@section('body')
	<div class="container">
		<div class="panel panel-default">
		<div class="panel-body">
		{{ Form::open(array('url' => '/client/update', 'class' => 'form-inline')) }}

		<h2 id="tables-example">Tasks</h2>
		<table class="table table-condensed">
			<tr>
				<th>Complete</th>
				<th>Due Date</th>
				<th>Title</th>
				<th>Description</th>
				<th>Attachment</th>
			</tr>
			<?php $assignments = Assignment::where('user_id', '=', Auth::user()->id)->orderby('duedate')->get(); ?>
			@foreach ($assignments as $assignment)
			<tr>
				<td>{{Form::checkbox('complete[]', $assignment->id,($assignment->complete==1)?true:false) ;}}</td>
				<td>{{$assignment->duedate}}</td>
				<td>{{$assignment->title}}</td>
				<td>{{$assignment->description}}</td>
				<td><a href='/file/{{$assignment->task_id}}'>{{$assignment->filename}}</a></td>
				<td>{{Form::hidden('assign_id'.$assignment->id, $assignment->id) ;}}</td>
			</tr>
			@endforeach
		</table>
		{{ Form::submit('Update', array('class' => 'btn btn-primary')); }}
		{{ Form::close(); }}
		</div>
		</div>
	</div>
@stop
