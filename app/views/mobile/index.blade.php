@extends('mobile.layout')

@section('content')

{{-- header and logo --}}

<div id="scrolling">
<header>
  <a href="/posts/mobile">
    <div id="logo">
      <img src ="/img/logo-mobile.png" width="150px" height="40px">
    </div>
  </a>
  <div id="aboutbutton">
    About
  </div>
</header>

{{-- Takeover: Channel Picker --}}
@if(!$isBlogger)
<div id="channelPicker" class="takeover">
  <div class="closebutton">
    <div>&times;</div>
  </div>
  <div class="info">
    <h2>
      Pick a Channel
    </h2>
    <ul>
      <a href="/mobile/posts/all"><li style="background-color:#EDEDED; color:black">Show All</li></a>
      <?php $channels = Channel::$list;?>
      @foreach ($channels as $key => $_channel)
        <a href="/mobile/posts/{{$_channel['name']}}" ><li style="border-left:5px solid {{$_channel['color']}}">{{$_channel['description']}}</li></a>
      @endforeach
    </ul>
  </div>
</div>
@endif

{{-- Takeover: Loading Curtain --}}

<div id="curtain">
  <div id="hangInThere">Loading..</div>
  <div id="backgroundPattern">
    
  </div>
</div>


{{-- Takeover: Share Sheet --}}

<div id="sharesheet" class="takeover dark">
  <div class="closebutton">
    <div>&times;</div>
  </div>
  <div class="bigCard">

    <a class="bloglink">
    <div class="blog">
      <img class="avatar"></img>
      <span class="title">This is a test</span>
    </div>
    </a>
    <a class="exitlink"><h2></h2></a>

    <p></p>

    <ul class="actions">
      <li class="goto">
        <a target="_blank" >Read</a>
      </li>
      <li class=" twittershare">
        <a href="" >{{fontAwesomeToSvg::convert('fa-twitter')}} Share</a>
      </li>
    </ul>
  </div> {{-- Big Card --}}
</div>


{{-- Takeover: About Lebanese Blogs --}}

<div id="about" class="takeover">
  <div class="closebutton">
    <div>&times;</div>
  </div>
  <div class="info">
    <h2>About <em>Lebanese Blogs</em></h2>
    <p>What would a Lebanese Magazine Look like if it were invented in the internet age?</p>
    <p>It would be a place like Lebanese Blogs, Where a vibrant community of passionate people write about the things they care about and share it with the world</p>
    <div class="action">
      <a href="/about" class="button">Learn More</a>
    </div>

  </div>
</div>


{{-- Takeover: Top Posts --}}
@if(!$isBlogger)
  <div id="topposts" class="takeover">
    <div class="closebutton">
      <div>&times;</div>
    </div>

  <h2>Top Posts</h2>
  @foreach($topPosts as $post)
    <div class="top_post">
      <div class="image">
        @include('mobile.topListThumb')
      </div>
      <div class="link">
        <a href="{{$post->post_url}}" class="article">{{$post->post_title}}</a><br><a href="{{$post->blog->blog_url}}" class="blog">{{$post->blog->blog_name}}</a>
      </div>
    </div>
  @endforeach

  </div>
@endif

{{-- top post or Blogger detail --}}

@if(!$isBlogger)
<div id="firstTopPost">
  <?php $post = $topPosts[0]; ?>
  <h2>Top Post Right Now <a id="showtopposts" class="minibutton" href="#">Show More</a></h2>
  <div class="top_post">
    <div class="image">
      @include('mobile.topListThumb')
    </div>
    <div class="link">
      <a href="{{$post->post_url}}" class="article">{{$post->post_title}}</a><br><a href="{{$post->blog->blog_url}}" class="blog">{{$post->blog->blog_name}}</a>
    </div>
  </div>
</div>

@else
<?php $post = $recentPosts[0] ?>
<div id="bloggerDetails">
  <img src="{{asset('/img/thumbs/'.$post->blog_id.'.jpg')}}">
  <h2>{{$post->blog->blog_name}}</h2>
</div>

@endif

{{-- Recent Posts --}}

<ul id="posts">
  @if(!$isBlogger)
  <div class="miniCard">
    {{View::make('mobile.categoriesButton')->with('channel', $channel)}}
  </div>
  @endif
  {{View::make('mobile.setOfPosts')->with('posts', $recentPosts)->with('isBlogger', $isBlogger)}}
</ul>

<div id="loadMorePosts" class="enabled">
  <div>Load More Posts</div>
</div>

{{-- Top Posts

<div class="group">
  <div class="header">
    Top Posts
  </div>

@foreach($topPosts as $post)
  <div class="top_post">
    <div class="image">
      @include('mobile.topListThumb')
    </div>
    <div class="link">
      <a href="{{$post->post_url}}" class="article">{{$post->post_title}}</a><br><a href="{{$post->blog->blog_url}}" class="blog">{{$post->blog->blog_name}}</a>
    </div>
  </div>
@endforeach

</div>
--}}
</div>
@stop
