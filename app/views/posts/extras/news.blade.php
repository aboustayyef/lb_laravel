<?php
if (!Cache::has('naharnet')) {
  return;
}
?>
<div class="post_wrapper">
  <div class="card news">
    <div class="newsheader">
      <h3>Latest Lebanon News <span class="beta">(beta)</span><small>Source: Naharnet</small></h3>
    </div>
    <?php
      $articles = Cache::get('naharnet');
      $feedTitle = $articles['meta']['feedTitle'];
      $articles = array_chunk($articles['content'], 5);
      $articles = $articles[0];
    ?>
    <ul>
      @foreach($articles as $article)
      <?php
        $virality = $article['virality'];
        $timeAgo = (new Carbon\Carbon($article['gmtDateTime']))->diffForHumans();
        $img = '/img/cache/naharnet/'.md5($article['img']).'.jpg';
        //$timeAgo = str_replace(' ', '&nbsp;', $timeAgo);
      ?>
        <li>
          <div class="newsitem">
            <div class="newsItemImage">
              <a href="{{$article['url']}}" target="blank"><img src="{{$img}}" alt=""></a>
            </div>
            <a href="{{$article['url']}}" target="blank">{{$article['headline']}}</a><br> <span class="timeAgo"> {{$timeAgo}}</span>
            {{View::make('posts.partials.virality')->with('score',$virality)}}
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</div>
