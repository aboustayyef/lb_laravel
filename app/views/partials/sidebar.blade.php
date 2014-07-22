<div id="sidebar">

  <div id="dismissSidebar"> <i class="fa fa-times-circle"></i>
  </div>

  <div id="channels">
    <h4 class="sectionheader">User Area</h4>
    <ul>
      <li> <i class="fa fa-star"></i>
        <a href="">My Favorite Bloggers</a>
      </li>
      <li>
        <i class="fa fa-list-alt"></i>
        <a href="">My Reading List</a>
      </li>
    </ul>

    <hr>

    <h4 class="sectionheader">Posts to Show</h4>
    <ul>
      <li>
        <i class="fa fa-home"></i>
        <a href="">Show All</a>
      </li>
      @foreach (Channel::$list as $channel)
      <li>
        <i class ="fa {{$channel['icon']}}"></i>
        {{link_to('/posts/'.$channel['name'], $channel['description'])}}
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