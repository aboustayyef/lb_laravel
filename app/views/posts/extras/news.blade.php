<?php

if (!Cache::has($source)) {
  return;
}
$articles = Cache::get($source)->articles->sortByDesc('virality')->take(5);
?>
<div class="card news">
  <h2 class="news__headline">Lebanon News</h2>
  <ul class="news__list">
  @foreach ($articles as $article)
    <li class="news__item">
      <a class="news__link" href="{{$article['url']}}">{{$article['headline']}}</a>
    </li> 
  @endforeach
  </ul>
  
</div>

