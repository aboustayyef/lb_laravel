@foreach($posts as $post)

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
  {{View::make('mobile.virality')->with('score',$post->post_virality)}}
</div>

<a href="{{URL::to('/exit').'?url='.urlencode($post->post_url).'&token='.Session::get('_token')}}" target="_blank" onclick="ga('send', 'event', 'Exit Link (mobile)', 'Card Posts' , '{{$post->blog->blog_name}}')"><p class="title">{{$post->post_title}}</p></a>

<?php
  if (($post->rating_denominator > 0) && ($post->rating_numerator > 1)) {
    echo '<!-- Rating -->';
    echo View::make('posts.partials.rating')->with('n',$post->rating_numerator)->with('d',$post->rating_denominator);
  }
?>

@if ($post->post_image_height > 0)
  <a href="{{URL::to('/exit').'?url='.urlencode($post->post_url).'&token='.Session::get('_token')}}" target="_blank" onclick="ga('send', 'event', 'Exit Link (mobile)', 'Card Posts' , '{{$post->blog->blog_name}}')"><div class="image">
    {{View::make('mobile.post_image')->with('post',$post)}}
  </div></a>
@endif


 <?php
      //$twitterLink = (new \LebaneseBlogs\Utilities\Strings)->prepareTwitterLink($post);
  ?>
  {{-- <a href="{{$twitterLink}}"><li>Share on Twitter</li></a> --}}

</li>
@endforeach
