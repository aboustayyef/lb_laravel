<div id="sidebar">
  <div id="scroller">
    <div id="channels">
      <h4 class="sectionheader">My Stuff</h4>
      <ul class="list">
        <li class="block"> <i class="fa fa-star"></i>
          <a href="">Favorite Blogs</a>
        </li>
        <li class="block">
          <i class="fa fa-list-alt"></i>
          <a href="">To&nbsp;Read</a>
        </li>
      </ul>

      <hr>

      <h4 class="sectionheader">Posts to Show</h4>
      <ul class="list">
        <li class ="list">
          <i class="fa fa-th"></i>
          <span class="dynamicLink" data-destination="{{URL::to('/posts/all')}}"> Show All</span>
        </li>
        @foreach (Channel::$list as $channel)
        <li class ="list">
          <i class ="fa {{$channel['icon']}}" style="color:{{$channel['color']}}"></i>
          <span class="dynamicLink" data-destination="{{URL::to('/posts/'.$channel['name'])}}"> {{$channel['description']}}</span>
          {{-- link_to('/posts/'.$channel['name'], $channel['description']) --}}
        </li>
        @endforeach
      </ul>

      <hr>

      <h4 class="sectionheader">RSS</h4>
      <ul>
        <li>
          <i class="fa fa-rss"></i>
          Lebanon's Best Feeds
        </li>
      </ul>
      <hr>
      <div class="credits">
        Designed and Built by
        <br>
        <a href="http://twitter.com/beirutspring">Mustapha Hamoui</a>
      </div>

    </div>
  </div>
</div>
