{{-- This is the initial set of posts --}}

@include('partials.header')
@include('partials.topbar')

@include('partials.postDetailsModal')

<div id="momentumScrollingViewport">
  <div id="content">
    @yield('content')
  </div>

</div>

@include('partials.footer')
