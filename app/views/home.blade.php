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

			<blockquote>Welcome back!  Below are your tasks for our next session.</blockquote>
		</div>
	</div>
@stop
