{{-- This is the initial set of posts --}}

@include('partials.header')
@include('partials.sidebar')
@include('partials.topbar')

<div id="content">
  @yield('content')
</div>

@include('partials.footer')
