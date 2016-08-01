@extends('manage.layout')

@section('content')
	<a href="/" class="btn btn-default btn-large">&larr; Home Page</a>
	<div id="MgHeading" class="row">
		<div class="col-sm-6"><h1>Manage Your Blogs</h1></div>
		<div class="col-sm-6">
			{{-- If Blogger has more than one blog, include tabs of the different blogs --}}
			
			<ul class="nav nav-pills pull-right">
				{{-- get list of other blogs by same person (if exists) --}}
		    	@foreach ($allBlogsByAuthor as $otherBlog)		
						<li @if ($otherBlog->blog_id == $blog->blog_id) class="active" @endif>
							<a href="/manage/{{$otherBlog->blog_id}}">
								{{$otherBlog->blog_name}}
							</a>
						</li>
		    	@endforeach
			    
			</ul>
		</div>
	</div>

	<hr>
	
	<div class="row">
		<div id="MgSubHeading" class="col-md-5">
			<img src="/img/thumbs/{{$blog->blog_thumb}}.jpg" width="50" height="auto">
			<h3>{{$blog->blog_name}}</h3>
			<a href="/manage/{{$blog->blog_id}}/edit/blog" class="btn btn-default btn-xs">Edit Blog Details</a>
			<a href="/blogger/{{$blog->blog_id}}" class="btn btn-default btn-xs">Blog Page</a>
		</div>
		
		<div id="stats" class="col-md-7">
			
		<h4>Statistics for Last 5 Posts <sup>*</sup></h4>
		<div class="tile_count row">
		
			@foreach ($stats as $stat)
				<div class="col-md-4 tile_stats_count">
				  <span class="count_top"><i class="fa {{$stat['statIcon']}}"></i> {{$stat['statTitle']}}</span>
				  <div class="count">{{$stat['value']}} 
				  <span class="label 
		
				  @if($stat['percentageChange'] > 0)
						label-success">&uarr; 
						{{abs($stat['percentageChange'])}}%
				  @elseif($stat['percentageChange'] < 0)
						label-danger">&darr; 
						{{abs($stat['percentageChange'])}}%
				  @else
				  		label-default">
						Same
				  @endif
				  </span></div>
				</div>
			@endforeach
		 	</div>
			<br>
		 	<small>* Percentage changes are relative to the previous 5 posts (read more in tips below)</small>
		</div>
	</div>

	
	<hr>

			<h3>Posts</h3>
			<table class="table">
				<thead>
					<th>Title (click on link to edit)</th>
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
		<h3>Tips</h3>
		<ul class="col-md-6">
			<li><strong>The statistics above</strong> compare your last 5 posts with your previous 5 posts. They give you a rough understanding of the progress of your blog in terms of posting frequency and virality. Sepaking of which:<br>&nbsp;</li>	

			<li><strong>Virality</strong> uses facebook data about how many times a post was shared/liked/commented. Shares are several times more valuable than likes, and likes are more valuable than comments. But all measures are included. Make sure you encourage your friends and family to share your posts to boost your virality<br>&nbsp;</li>

			<li><strong>Clicks</strong> are the number of times users have clicked on your link on Lebanese Blogs. Each device (computer or mobile) only counts once. If your average clicks are low, make sure your titles are interesting enough and produce enough curiosity to invite more clicks. Another way to boost clicks is to introduce your fans to Lebanese Blogs :)</li>
		</ul>
@stop
@section('scripts.footer')
	<script src="/js/management.js"></script>
@stop