@foreach($posts as $post)

<li class="miniCard post">

@if(!$isBlogger)
  <a href="/mobile/blogger/{{$post->blog->blog_id}}">
    <div class="header">
      <img 
      @if (app('env') == 'staging')
          src="{{ asset('http://static.lebaneseblogs.com/img/transparent.png') }}"
          data-original="http://static1.lebaneseblogs.com/{{$post->blog_id.'.jpg'}}"
      @else
          src="{{ asset('/img/transparent.png') }}"
          data-original="{{asset('/img/thumbs/'.$post->blog_id.'.jpg')}}"
      @endif
      style="background: #F3E7E8"
      width="29"
      height="29"
      alt="post thumbnail" 
      class="blogthumb lazy"
      >
      <p class="blogtitle">{{$post->blog->blog_name}}</p>
    </div>
  </a>


@endif
<!--
<div class="body" data-exit-url="{{URL::to('/exit').'?url='.urlencode($post->post_url).'&token='.Session::get('_token')}}" data-blog-url="/mobile/blogger/{{$post->blog->blog_id}}" data-post-title="{{$post->post_title}}" data-twitter-link="{{(new \LebaneseBlogs\Utilities\Strings)->prepareTwitterLink($post)}}" data-post-excerpt="{{$post->post_excerpt}}" data-blog-name="{{$post->blog->blog_name}}" data-blog-id="{{$post->blog_id}}">
-->
<div class="postbody">
<div class="meta">
  <div class="timestamp">
    <?php $since = (new Carbon\Carbon)->createFromTimestamp($post->post_timestamp)->diffForHumans(); ?>
    {{$since}}
  </div>
  {{View::make('mobile.virality')->with('score',$post->post_virality)}}
</div>

<a href="{{$post->exitLink()}}"><p class="title">{{$post->post_title}}</p></a>

@if ($post->hasRating())
    <!-- Rating -->
    {{-- Hide rating for now: --}}
    {{-- View::make('posts.partials.rating')->with('n',$post->rating_numerator)->with('d',$post->rating_denominator) --}}
@endif

@if ($post->image()->exists)
    {{View::make('mobile.post_image')->with('post',$post)}}
@endif
</div>

 <?php
      //$twitterLink = (new \LebaneseBlogs\Utilities\Strings)->prepareTwitterLink($post);
  ?>
  {{-- <a href="{{$twitterLink}}"><li>Share on Twitter</li></a> --}}

</li>
@endforeach
