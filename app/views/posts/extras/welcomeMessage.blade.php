<div id="welcomeMessage" class="card push_down no_min">
  <div>
    <h2>
      Discover and Follow the Best Lebanese Blogs
    </h2>
  </div>
  <div class="buttonswrapper">
    <a href="{{URL::to('/auth/twitter')}}"><img class="lazy" data-original="{{asset('img/login_with_twitter.png')}}" style="background: #F3E7E8"
src="{{ asset('/img/transparent.png') }}" width="90px" height="34px" alt=""></a>
    <a href="{{URL::to('/auth/facebook')}}"><img class="lazy" data-original="{{asset('img/login_with_facebook.png')}}" style="background: #F3E7E8"
src="{{ asset('/img/transparent.png') }}" width="90px" height="34px" alt=""></a>
    <a href="{{URL::to('/auth/google')}}"><img class="lazy" data-original="{{asset('img/login_with_google.png')}}" style="background: #F3E7E8"
src="{{ asset('/img/transparent.png') }}" width="90px" height="34px" alt=""></a>
  </div>
  <div class="whySignup">
    Logging in allows you to personalize your feed by following blogs and liking posts.
  </div>
</div>
