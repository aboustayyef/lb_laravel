{{-- This is the initial set of posts --}}

@include('partials.header')
@include('partials.topbar')

@include('partials.postDetailsModal')

<div id="content">
	@yield('content')
</div>

@include('partials.footer')
