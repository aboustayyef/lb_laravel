<div id="topBar" style="height:50px">
	<div id="hamburger">
		<i class="fa fa-bars"></i>
	</div>

	<div id="logo" class="dynamicLink" data-destination="{{URL::to('/')}}">	</div>

	<div id= "about">
		About ▾
	</div>
	<div id="aboutMenu">
		<ul>
			<li><a href="{{URL::to('/about')}}">What is this Website?</a></li>
			<li><a href="{{URL::to('/about/faq')}}">Frequently Asked Question</a></li>
      <li><a href="{{URL::to('/about/submit')}}">Submit Your Blog</a></li>
			<li><a href="{{URL::to('/about/feedback')}}">Submit Feedback</a></li>
			<li><a href="http://blog.lebaneseblogs.com">Our own Blog</a></li>
			<li><a href="#">Admin</a></li>
		</ul>
	</div>
</div>
