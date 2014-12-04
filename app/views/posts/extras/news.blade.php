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
      $articles = array_chunk($articles, 5);
      $articles = $articles[0];
    ?>
    <ul>
      @foreach($articles as $article)
      <?php $virality = $article['virality']; ?>
        <li>
          <div class="newsitem">
            <a href="{{$article['url']}}" target="blank">{{$article['headline']}}</a>
            {{View::make('posts.partials.virality')->with('score',$virality)}}
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</div>
