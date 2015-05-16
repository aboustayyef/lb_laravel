{{-- Populate Cache in nonexistent --}}

@if(!Cache::has('toptweets'))
  <?php
    $toptweets = shell_exec('curl ' . getenv('LT_API_CREDENTIALS'));
    $toptweets = json_decode($toptweets);
    Cache::put('toptweets',$toptweets, 10);
  ?>
@endif
<?php
    $toptweets = Cache::get('toptweets');
?>

{{-- populate --}}

<div class="post_wrapper">
  <div class="card">

    <div class="topTweetsHeader">
      <h4>Popular Tweets In Lebanon</h4>
      <div class="poweredby">Powered By <a href="http://lebanesetweets.net" onclick="ga('send', 'event', 'Exit Link', 'Top Tweets')">Lebanese Tweets</a></div>
    </div>

    <ul>
    @foreach ($toptweets as $key => $tweet)

    <?php
      // check if Arabic
      $isArabic = false;
      if (LebaneseBlogs\Utilities\Strings::isMostlyArabic($tweet->content)) {
        $isArabic = true;
      }
    ?>


      <li class="tweet">
        <div class="profilepic">
          <a href="https://twitter.com/{{$tweet->tweep_twitterHandle}}/status/{{$tweet->twitter_id}}" onclick="ga('send', 'event', 'Exit Link', 'Top Tweets')">
            <img src="{{$tweet->user_image}}">
          </a>

        </div>
        <div class="content">
          <h5><strong>{{$tweet->tweep_public_name}}</strong> {{'@'.$tweet->tweep_twitterHandle}}</h5>
          <p @if($isArabic) class="arabic" @endif>{{$tweet->content}}</p>
          @if($tweet->media)
            <div class="media">
               <a href="https://twitter.com/{{$tweet->tweep_twitterHandle}}/status/{{$tweet->twitter_id}}" onclick="ga('send', 'event', 'Exit Link', 'Top Tweets')">
                <img src="{{$tweet->media}}" width="{{$tweet->media_width}}" height="auto">
              </a>
            </div>
          @elseif($tweet->link)
            @if($tweet->link->image)
            <div class="media">
               <a href="https://twitter.com/{{$tweet->tweep_twitterHandle}}/status/{{$tweet->twitter_id}}" onclick="ga('send', 'event', 'Exit Link', 'Top Tweets')">
                <img src="http://lebanesetweets.net/{{$tweet->link->image}}" width="{{$tweet->link->image_width}}" height="auto">
              </a>
            </div>
            @endif
          @endif
          <ul class="popularity">
            <li><a href="https://twitter.com/{{$tweet->tweep_twitterHandle}}/status/{{$tweet->twitter_id}}" onclick="ga('send', 'event', 'Exit Link', 'Top Tweets')">@include('svgicons.link') link</a></li>
            <li>@include('svgicons.favorites') {{$tweet->favorites}}</li>
            <li>@include('svgicons.retweets') {{$tweet->retweets}}</li>
          </ul>
        </div>
      </li>
    @endforeach
    </ul>
  </div>
</div>
