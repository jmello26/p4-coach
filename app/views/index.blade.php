@extends('main')

@section('title')
	Life Coach, Inc.
@stop

@section('body')
	<div class="container theme-showcase" role="main">
		<div class="jumbotron">
			{{-- Clickable image to bring users back to this page --}}
			<!-- <a href='/'>{{ HTML::image('/images/p3.png', 'Site Logo'); }}</a> -->
			<h1>Life Coach, Inc.</h1>

			<blockquote>Life Coach, Inc. is a pretend life coaching business where coaches and clients can 
			sign on to the site and manage their goals and tasks from session to session.
			</blockquote>
		</div>
	</div>
@stop
