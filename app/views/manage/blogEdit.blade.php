<?php
	$blog = Blog::where('blog_id', $blogId)->get()->first();
?>

@extends('manage.layout')

@section('title')
Edit Blog Details
@stop

@section('content')

	<h1>Edit Blog Details</h1>

	<div class="row">

		<form action="/manage/{{$blog->blog_id}}/edit/blog" method="POST" accept-charset="utf-8" class="col-md-8">
	
			{{Form::token()}}
	
			<div class="form-group">
				<label for="blog_name">Name of Blog</label>
				<input type="text" name="blog_name" class="form-control" value="{{$blog->blog_name}}">
			</div>

			<div class="form-group">
				<label for="blog_description">Description of Blog</label>
				<textarea name="blog_description" class="form-control">{{$blog->blog_description}}</textarea>
			</div>

			<div class="form-group">
				<label for="blog_author">Name of Author (Leave empty if you want to remain anonymous)</label>
				<input type="text" name="blog_author" class="form-control" value="{{$blog->blog_author}}">
			</div>

			<div class="form-group">
				<label for="blog_author_twitter_username">Associated Twitter Account (Please talk with admin if you want to change this) </label>
				<input type="text" name="blog_author_twitter_username" class="form-control" value="{{$blog->blog_author_twitter_username}}" disabled>
			</div>

			<ul>
				Todo:
				<li>Tags </li>
				<li>Validation </li>
			</ul>
			
			<button class="btn btn-primary">
				Submit
			</button>

		</form>
	
	</div>

@stop

