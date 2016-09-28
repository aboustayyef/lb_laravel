<?php 
$published = new \Carbon\Carbon('12/28/2015');
$now = new Carbon\Carbon();
$diff = $now->diffInDays($published);
?>

{{--  Only show this if stats published less than 8 days ago --}}

@if ($diff < 8)
	<div id="welcomeMessage" class="card push_down no_min" style="padding:0;border:0">
	<a href="https://stats2015.lebaneseblogs.com">
	<img 
		width="300";
		height="100";
		class="lazy" 
		src="{{asset('https://static.lebaneseblogs.com/img/transparent.png') }}" 
		data-original="{{ asset('/img/stats2015_banner.png')}}"
		alt=""
		> 
	</div>
	</a>
@endif
