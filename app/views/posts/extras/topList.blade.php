<?php

  if (Session::has('channel')) {
    $channel = Session::get('channel');
  } else {
    $channel = 'all';
  }

  $postsReady = false;
  $possibleTimeFrames = [12, 24, 72, 168];

  // first check if $hours is set (through a get input)
  if (isset($hours)) {
    $posts = Post::getTopPosts($channel, $hours);
    if ($posts->count() > 4) {
      $postsReady = true;
      $numberOfHours = $hours;
    }
  }
  if (!$postsReady) {
    foreach ($possibleTimeFrames as $key => $hours) {
      $posts = Post::getTopPosts($channel, $hours);
      if ($posts->count() > 4) {
        $numberOfHours = $hours;
        break;
      }
    }
  }

  if ($posts->count() < 5 ) {
    die('You need to update database with recent posts');
  }
?>
<div class="post_wrapper toplist">
  <div class="card push_down no_min">I am testing another card before main card</div>
  <div class="card">
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
    ), $numberOfHours, array('id' => 'topListScoper')) }}
    {{ Form::close() }}

    <ul>
      @foreach ($posts as $post)
      <li>
        <div class="item">
          <div class="thumb">
            <a href ="{{$post->post_url}}">
              {{View::make('images.topListThumb')->with('post',$post)}}
            </a>
          </div>
          <div class="details">
            <h3><a href ="{{$post->post_url}}">{{$post->post_title}}</a></h3>
            <h4>{{$post->blog->blog_name}}</h4>
          </div>
        </div>
      </li>
      @endforeach
    </ul>
  </div>
</div>
