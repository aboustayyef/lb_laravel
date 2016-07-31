<?php
	Session::set('WhereAmI', Request::path());
?>
{{-- This is the initial set of posts --}}

@include('partials.header')

@include('partials.topbar')
@include('posts.partials.channelPicker')

<div id="content">
	@yield('content')
</div>

@include('partials.footer')