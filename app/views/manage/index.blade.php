@extends('manage.layout')

<?php
	
	$allBlogsByAuthor = Blog::where('blog_author_twitter_username', $blog->blog_author_twitter_username)->get();
	$posts = $blog->posts()->orderBy('post_timestamp', 'desc')->take(10)->get();

	$average_virality = round($posts->reduce(function($total, $post){return $post->post_virality + $total;}) / $posts->count());

	$total_clicks = $posts->reduce(function($total,$post){return $post->post_visits + $total;});

	$average_posts_per_week = round((7*24) / ($posts->first()->carbonDate()->diffInHours($posts->last()->carbonDate()) / 10),2);

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

	<h2>{{$blog->blog_name}} <a href="/manage/{{$blog->blog_id}}/edit/blog" class="btn btn-default btn-xs">Edit Blog Details</a></h2>
	

	<hr>
	

	<h3>Statistics</h3>
	<div class="row tile_count">
	    
	    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	      <span class="count_top"><i class="fa fa-bar-chart"></i> Average Virality</span>
	      <div class="count">{{$average_virality}}</div>
	      <span class="count_bottom"><i class="green">4% </i> From previous ten</span>
	    </div>

	    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	      <span class="count_top"><i class="fa fa-dot-circle-o"></i> Total Clicks</span>
	      <div class="count">{{$total_clicks}}</div>
	      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From previous ten</span>
	    </div>

	    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	      <span class="count_top"><i class="fa fa-bar-chart"></i> Avg Posts / Week</span>
	      <div class="count green">{{$average_posts_per_week}}</div>
	      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From previous ten</span>
	    </div>

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