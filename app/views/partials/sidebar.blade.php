<div id="sidebar">
  <div class="close">
    <a href ="#">&times;</a>
  </div>
  <div id="scroller">
  <?php $ourUser = User::find(User::signedIn()) ?>
    <div id="userArea">
      <div class="profilePicture">
        @if($ourUser)
          <img src="{{$ourUser->profileImage()}}" alt="">
        @else
          <img src="{{ asset('/img/placeholder_profile_pic.png') }}" alt="">
        @endif
      </div>
      @if ($ourUser)
        <div class="greeting">
          Hello {{$ourUser->firstName()}}!
          <div class="tools">
            <ul>
              <li><i class="fa fa-star"></i><a href="/posts/favorites">Favorite Blogs</a> <span class="amount favorites">{{$ourUser->howManyFavoritedBlogs()}}</span></li>
              <li><i class="fa fa-list-alt"></i><a href="#">Saved Posts</a> <span class="amount saved">{{$ourUser->howManySavedPosts()}}</span></li>
              <li><i class="fa fa-sign-out"></i><a href="{{URL::to('/logout')}}">Sign Out</a></li>
            </ul>
          </div>
        </div>
      @else
        <div class="login">
          <a href="{{URL::to('/login')}}">Sign in</a>
          <p>Login for free to use features like favoriting blogs, saving posts and, if you're a blogger, editing &amp; organizing your posts</p>
        </div>
      @endif
    </div>

    <div id="channels">

      <h3>Blog Channels</h3>
      <?php $currentChannel = Session::get('channel'); ?>
      <ul>

        <li class ="categoryButton @if($currentChannel == 'all' || empty($currentChannel))selected @endif dynamicLink" data-destination="{{URL::to('/posts/all')}}">
          <i class="fa fa-th"></i> Show Me Everything
        </li>
        @foreach (Channel::$list as $channel)
        <li class ="categoryButton dynamicLink" data-destination="{{URL::to('/posts/'.$channel['name'])}}"
        @if($channel['name'] == $currentChannel)
          style="background: {{$channel['color']}}"
        @else
          style="border-left: solid 3px {{$channel['color']}}"
        @endif
        >
          <i class ="fa {{$channel['icon']}}"></i> {{$channel['description']}}
        </li>
        @endforeach
      </ul>
    </div>
      <div class="credits">
        Designed and Built by
        <br>
        <a href="http://twitter.com/beirutspring">Mustapha Hamoui</a>
      </div>
  </div>
</div>
