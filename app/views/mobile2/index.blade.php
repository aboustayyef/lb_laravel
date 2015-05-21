@extends('mobile2.layout')

@section('content')

{{-- header and logo --}}

<div id="scrolling">
<header>
  <div id="logo">
    <img src ="/img/logo-mobile.png" width="150px" height="40px">
  </div>
  <div id="aboutbutton">
    About
  </div>
</header>

{{-- Takeover: Loading Curtain --}}

<div id="curtain" class="takeover active">
  <div class="deadcenter">
    <img src="{{asset('img/lb-loading.png')}}" width="60px" height="auto"><br>Loading...
  </div>
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

<div id="topposts" class="takeover">
  <div class="closebutton">
    <div>&times;</div>
  </div>

<h2>Top Posts</h2>
@foreach($topPosts as $post)
  <div class="top_post">
    <div class="image">
      @include('mobile2.topListThumb')
    </div>
    <div class="link">
      <a href="{{$post->post_url}}" class="article">{{$post->post_title}}</a><br><a href="{{$post->blog->blog_url}}" class="blog">{{$post->blog->blog_name}}</a>
    </div>
  </div>
@endforeach

</div>

{{-- recent posts (3) --}}
<div id="showtopposts">
  Show Top Posts
</div>

<ul id="posts">
  @for($i=0; $i<16; $i++)
    <?php $post = $recentPosts[$i] ;?>



  <li class="miniCard" data-post-url="{{$post->post_url}}" data-blog-url="{{$post->blog->blog_url}}">

    <div class="header">
      <img src="{{asset('/img/thumbs/'.$post->blog_id.'.jpg')}}" alt="" class="blogthumb">
      <p class="blogtitle">{{$post->blog->blog_name}}</p>
    </div>
    <div class="meta">
      <div class="timestamp">
        <?php $since = (new Carbon\Carbon)->createFromTimestamp($post->post_timestamp)->diffForHumans(); ?>
        {{$since}}
      </div>
      {{View::make('mobile2.virality')->with('score',$post->post_virality)}}
    </div>

    <p class="title">{{$post->post_title}}</p>

    @if ($post->post_image_height > 0)
      <div class="image">
        {{View::make('mobile2.post_image')->with('post',$post)}}
      </div>
    @endif
    </li>
    @endfor
</ul>

{{-- Top Posts

<div class="group">
  <div class="header">
    Top Posts
  </div>

@foreach($topPosts as $post)
  <div class="top_post">
    <div class="image">
      @include('mobile2.topListThumb')
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
