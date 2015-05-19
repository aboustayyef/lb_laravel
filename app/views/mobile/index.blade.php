@extends('mobile.layout')

@section('content')

{{-- header and logo --}}
<header>
  <div id="logo">
    <img src ="/img/logo-mobile.png" width="150px" height="40px">
  </div>
  <div id="about">
    <a href="/about">About</a>
  </div>
</header>


{{-- recent posts (3) --}}

<div class="group">
  <div class="header">Latest Posts</div>
  <ul>
  @for($i=0; $i<3; $i++)
    <?php $post = $recentPosts[$i] ;?>
    <li>
      <div class="timestamp">
        <?php $since = (new Carbon\Carbon)->createFromTimestamp($post->post_timestamp)->diffForHumans(); ?>
        {{$since}}
      </div>
      <div class="link">
        <?php $blogname = str_replace(' ', '&nbsp;', $post->blog->blog_name) ?>
        <a href="{{$post->post_url}}" class="article">{{$post->post_title}}</a> - <a href="{{$post->blog->blog_url}}" class="blog">{{$blogname}}</a></div>
    </li>
    @endfor
  </ul>
</div>


{{-- Top Posts --}}

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


{{-- Previous Posts  --}}

{{-- recent posts (3) --}}

<div class="group">
  <div class="header">Earlier Posts</div>
  <ul>
  @for($i=3; $i<23; $i++)
    <?php $post = $recentPosts[$i] ;?>
    <li>
      <div class="timestamp">
        <?php $since = (new Carbon\Carbon)->createFromTimestamp($post->post_timestamp)->diffForHumans(); ?>
        {{$since}}
      </div>
      <div class="link">
        <?php $blogname = str_replace(' ', '&nbsp;', $post->blog->blog_name) ?>
        <a href="{{$post->post_url}}" class="article">{{$post->post_title}}</a> - <a href="{{$post->blog->blog_url}}" class="blog">{{$blogname}}</a></div>
    </li>
    @endfor
  </ul>
</div>

@stop
