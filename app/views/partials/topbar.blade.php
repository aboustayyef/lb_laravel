<div id="topBar">
	<div id="hamburger">
		<i class="fa fa-bars"></i>
	</div>

	<div id="logo">
		<div class="full">
			<a href="{{URL::to('/posts/all')}}"><img src="{{asset('/img/logo.png')}}" width="250" height="40" alt="Lebanese Blogs Logo"></a>
		</div>
		<div class="mobile">
			<a href="{{URL::to('/posts/all')}}"><img src="{{asset('/img/logo-mobile.png')}}" width="150" height="40" alt="Lebanese Blogs Logo"></a>
		</div>
	</div>

	<div id= "about">
		<i class="fa fa-info-circle"></i>
	</div>
	<div id="aboutMenu">
		<ul>
			<li><a href="">About</a></li>
			<li><a href="">Submit Your Blog</a></li>
			<li><a href="">Submit Feedback</a></li>
			<li><a href="">Our own Blog</a></li>
			<li><a href="">Admin</a></li>
		</ul>
	</div>
	<div id="search">
		<i class="fa fa-search"></i>
	</div>
	<div id="searchMenu">
		<ul>
			<li>
				{{Form::open(array(	'url' => 'posts/search' )) }}
				
				{{Form::label('searchPosts','Search Thousands of Blog Posts')}}
				{{Form::text('searchPosts')}}

				{{ Form::close() }}					
			</li>
		</ul>
	</div>
</div>