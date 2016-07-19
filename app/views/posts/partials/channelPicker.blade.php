<div id="channelPicker">
  {{--Request::path()--}}
<div class="ut__inner ut__space_between">

  {{-- We use a Selector for mobile only --}}
  <select name="channelSelector" id="channelSelector">
    @if(Request::path() == 'posts/all')
      <option >Pick A Channel</option>
    @else
      <option data-target="{{URL::to('/posts/all')}}">Show All</option>
    @endif
    @foreach (Channel::$list as $channel)
      <option data-target="{{URL::to('/posts/'.$channel['name'])}}" @if(strpos(Request::path(), $channel['name'])) selected="selected" @endif>
        {{$channel['description']}}
      </option>
    @endforeach
  </select>

  <div class="ut__flexWrapper">
    @if(Session::has('SignedInUser'))
      <?php 
        $userDetails = Session::get('SignedInUser'); 
      ?> 
    
      <div class="user">
            <img class="lazy" src="/img/transparent.png" data-original="{{$userDetails['imageUrl']}}" height = "27px" width ="27px">
          <a href="" class="top_posts__button">
            Manage My Blogs
          </a>
          <a href="/signout" class="top_posts__button">
            Sign Out
          </a>
      </div>
    
    @else
      <div class="user">
      @if(Session::has('NoBlogFound'))
        <div class="error_message">
          Sorry, No blog is associated with that twitter id&nbsp;
        </div>
      @endif
        <img src="/img/transparent.png" alt="" class="lazy" data-original="/img/keyboard-icon.png" height="25px" width="25px">
        <a href="/auth/twitter" class="top_posts__button">
          Blogger Sign In
        </a>
      </div>
    @endif
    
    <label id="openLinksInNewTabs" class="ios7-switch">
        <span class="lbl">Open Links in New Tabs</span>
        <input id="newtabs" type="checkbox" checked>
        <span></span>
    </label>
  </div>

</div> {{-- inner --}}

</div> {{-- channelPicker --}}