<div id="sidebar">
  <div id="scroller">
  <?php $ourUser = User::find(User::signedIn()) ?>
    <div id="userArea">
      <div class="close">
        <a href ="#">&times;</a>
      </div>
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
              <li><i class="fa fa-th"></i><a href="/posts/all">All Blogs</a></li>
              <li><i class="fa fa-check"></i><a href="/user/following">Followed Blogs</a> <span class="amount favorites">{{$ourUser->followsHowMany()}}</span></li>
              <li><i class="fa fa-heart"></i><a href="/posts/saved">liked Posts</a> <span class="amount saved">{{$ourUser->LikedHowMany()}}</span></li>
              <li><i class="fa fa-sign-out"></i><a href="{{URL::to('/logout')}}">Sign Out</a></li>
            </ul>
          </div>
        </div>
      @else
        <div class="login">
          <a href="{{URL::to('/login')}}">Log in</a>
          <p>Enable features like favoriting blogs, saving posts and, if you're a blogger, editing &amp; organizing your posts</p>
        </div>
      @endif
    </div>

    <div id="channels">
      <h3>Search Thousands of Posts</h3>
      <div class="searchform">
        {{Form::open(array( 'url' => 'posts/search', 'method' =>  'get' )) }}

        {{Form::text('q')}}
        {{Form::submit('Find')}}
        {{ Form::close() }}
      </div>
      <h3>Filter Posts By Topics</h3>
      <?php $currentChannel = Session::get('channel'); ?>
      <ul>

        @foreach (Channel::$list as $channel)
        <li class ="categoryButton dynamicLink" data-destination="{{URL::to('/posts/'.$channel['name'])}}"
        <?php if (!in_array(Session::get('pageKind'), ['favorites', 'saved', 'search'])): ?>
          @if($channel['name'] == $currentChannel)
            style="background: {{$channel['color']}}"
          @else
            style="border-left: solid 3px {{$channel['color']}}"
          @endif
        <?php endif; ?>
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
