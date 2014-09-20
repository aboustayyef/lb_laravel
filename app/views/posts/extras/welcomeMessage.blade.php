<div id="welcomeMessage" class="card push_down no_min">
  <div>
    <h2>
      Discover and Follow the Best Lebanese Blogs
    </h2>
    <p>
      Lebanese Blogs is the best place to keep up with the brightest people writing about lebanon and their passions {{link_to('/about','learn more')}}
    </p>
  </div>
  <div class="buttonswrapper">
    <a href="{{URL::to('/auth/twitter')}}"><img src="{{asset('img/login_with_twitter.png')}}" width="90px" height="34px" alt=""></a>
    <a href="{{URL::to('/auth/facebook')}}"><img src="{{asset('img/login_with_facebook.png')}}" width="90px" height="34px" alt=""></a>
    <a href="{{URL::to('/auth/google')}}"><img src="{{asset('img/login_with_google.png')}}" width="90px" height="34px" alt=""></a>
  </div>
  <div class="whySignup">
    Logging in allows you to personalize your feed by following blogs and liking posts.
  </div>
</div>
