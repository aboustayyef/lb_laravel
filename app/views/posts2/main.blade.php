@extends('posts2.layout')

@section('title')
This is the title
@stop

@section('description')
This is the description
@stop

@section('content')
<ul>
	@foreach($posts as $post)
	<li>
		<div>
			<h2>{{$post->post_title}}</h2>	
			<p>{{$post->post_excerpt}}</p>
			<hr>
		</div>
	</li>
	@endforeach
</ul>
@stop