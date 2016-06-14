@extends('posts2.layout')

@section('title')
	This is the title
@stop

@section('description')
	This is the description
@stop

@section('content')
	@foreach($posts as $post)
		<article>
			<header>
				<h2>{{$post->post_title}}</h2>			
			</header>
			<section>
				<p>{{$post->post_excerpt}}</p>
			</section>
			<footer>
				<hr>
			</footer>
		</article>
	@endforeach
@stop