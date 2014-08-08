<?php

  if (Session::has('channel')) {
    $channel = Session::get('channel');
  } else {
    $channel = 'all';
  }
  $hours = 12;
  $posts = Post::getTopPosts($channel, $hours);
  while ( count($posts) < 5) {
    $hours = $hours * 2;
    $posts = Post::getTopPosts($channel, $hours);
  }
?>
<div class="post_wrapper toplist">
  <h2>Top Posts</h2>
  @if ($channel != 'all')
    <h3 class ="category" style="color:{{Channel::color($channel)}}">In {{Channel::description($channel)}}</h3>
  @endif

  {{Form::open(array('url'=>'my/route'))}}
  {{Form::select('time_scope', array(
    '12'    =>  '12 hours',
    '24'    =>  '24 hours',
    '72'    =>  '3 days',
    '168'   =>  '7 days'
  ), '12', array('id' => 'topListScoper')) }}
  {{ Form::close() }}

  <ul>
    @foreach ($posts as $post)
    <li>
      <div class="item">
        <div class="thumb">
          {{View::make('images.topListThumb')->with(array('image'=>$post->post_image, 'height'=>$post->post_image_height, 'width'=>$post->post_image_width))}}
        </div>
        <div class="details">
          <h3>{{$post->post_title}}</h3>
          <h4>{{$post->blog_name}}</h4>
        </div>
      </div>
    </li>
    @endforeach

  </ul>
</div>
