@extends('main')

@section('title')
	Life Coach, Inc.
@stop

@section('jumbo')
	<blockquote>Welcome back! {{Auth::user()->firstname}}  Below are your current tasks.</blockquote>
@stop

@section('body')
	<div class="container">
		<div class="panel panel-default">
		<div class="panel-body">

		<h2 id="tables-example">Assignments</h2>
		<table class="table table-condensed">
			<tr>
				<th>Completed</th>
				<th>Due Date</th>
				<th>Title</th>
				<th>Description</th>
				<th>Attachment</th>
			</tr>
			<?php $assignments = Assignment::where('user_id', '=', Auth::user()->id)->get(); ?>
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
	</div>
@stop
