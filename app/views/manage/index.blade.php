@extends('manage.layout')

<?php
	
	$allBlogsByAuthor = Blog::where('blog_author_twitter_username', $blog->blog_author_twitter_username)->get();
	$posts = $blog->posts()->orderBy('post_timestamp', 'desc')->take(10)->get();

	$stats = $blog->stats();

?>

@section('content')
	
	{{-- If Blogger has more than one blog, include tabs of the different blogs --}}
	
	<ul class="nav nav-tabs">
		{{-- get list of other blogs by same person (if exists) --}}
    	@foreach ($allBlogsByAuthor as $otherBlog)		
				<li @if ($otherBlog->blog_id == $blog->blog_id) class="active" @endif>
					<a href="/manage/{{$otherBlog->blog_id}}">
						{{$otherBlog->blog_name}}
					</a>
				</li>
    	@endforeach
	    
	</ul>

	<div class="row">
		<div class="col-sm-1"><br><img src="/img/thumbs/{{$blog->blog_id}}.jpg" class="img-responsive img-thumbnail"></div>
		<div class="col-sm-11"><h2>{{$blog->blog_name}} <a href="/manage/{{$blog->blog_id}}/edit/blog" class="btn btn-default btn-xs">Edit Blog Details</a></h2></div>
	</div>

	
	<hr>
	

	<h3>Statistics for Last 5 Posts</h3>
	<div class="row tile_count">

		@foreach ($stats as $stat)
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
			  <span class="count_top"><i class="fa {{$stat['statIcon']}}"></i> {{$stat['statTitle']}}</span>
			  <div class="count">{{$stat['value']}}</div>
			  <span class="count_bottom
			  @if($stat['percentageChange'] > 0)
			  	green">
			  	<i class="fa fa-angle-up"></i>
			  @elseif($stat['percentageChange'] < 0)
			  	red">
			  	<i class="fa fa-angle-down"></i>
			  @endif
			  	{{abs($stat['percentageChange'])}}% </i> From previous 5
			  </span>
			</div>
		@endforeach

 	</div>

	
	<hr>

			<h3>Posts</h3>
			<table class="table">
				<thead>
					<th>Post (click on link to edit)</th>
					<th>Date</th>
					<th>Virality</th>
					<th>Clicks</th>
				</thead>
				<tbody>
					@foreach($posts as $post)
						<tr>
							<td>
								<a href="/manage/{{$blog->blog_id}}/edit/post/{{$post->post_id}}">
								{{$post->post_title}}
								</a>
							</td>
							<td>{{$post->carbonDate()->diffForHumans()}}</td>
							<td>{{$post->post_virality}}</td>
							<td>{{$post->post_visits}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		<h3>Blog Details</h3>
@stop
@section('scripts.footer')
	<script src="/js/management.js"></script>
@stop