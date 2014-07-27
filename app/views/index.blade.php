@extends('main')

@section('title')
	Life Coach, Inc.
@stop

@section('body')
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	    <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="navbar-brand" href="#">Bootstrap theme</a> -->
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/signup">Sign up</a></li>
            <li><a href="/login">Log in</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
	</div>
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
