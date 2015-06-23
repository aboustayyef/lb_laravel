@foreach($posts as $post)

<li class="miniCard post" data-exit-url="{{URL::to('/exit').'?url='.urlencode($post->post_url).'&token='.Session::get('_token')}}" data-blog-url="/mobile/blogger/{{$post->blog->blog_id}}" data-post-title="{{$post->post_title}}" data-twitter-link="{{(new \LebaneseBlogs\Utilities\Strings)->prepareTwitterLink($post)}}">

@if(!$isBlogger)

  <div class="header">
      <img src="{{asset('/img/thumbs/'.$post->blog_id.'.jpg')}}" alt="" class="blogthumb">
      <p class="blogtitle">{{$post->blog->blog_name}}</p>
  </div>

@endif
<div class="meta">
  <div class="timestamp">
    <?php $since = (new Carbon\Carbon)->createFromTimestamp($post->post_timestamp)->diffForHumans(); ?>
    {{$since}}
  </div>
  {{View::make('mobile.virality')->with('score',$post->post_virality)}}
</div>

<p class="title">{{$post->post_title}}</p>

<?php
  if (($post->rating_denominator > 0) && ($post->rating_numerator > 1)) {
    echo '<!-- Rating -->';
    echo View::make('posts.partials.rating')->with('n',$post->rating_numerator)->with('d',$post->rating_denominator);
  }
?>

@if ($post->post_image_height > 0)
 <div class="image">
    {{View::make('mobile.post_image')->with('post',$post)}}
  </div>
@endif


 <?php
      //$twitterLink = (new \LebaneseBlogs\Utilities\Strings)->prepareTwitterLink($post);
  ?>
  {{-- <a href="{{$twitterLink}}"><li>Share on Twitter</li></a> --}}

</li>
@endforeach
