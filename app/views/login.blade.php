{{-- This shows the sign in buttons for the various services. We start with facebook --}}
{{-- Eventually make it nicer--}}

@if (Session::has('message'))
<h3>{{Session::get('message')}}</h3>
@endif

<a href="{{URL::to('/auth/facebook')}}">Sign In With Facebook</a><br>
<a href="{{URL::to('/auth/twitter')}}">Sign In With Twitter</a><br>
<a href="{{URL::to('/auth/google')}}">Sign In With Google</a>
