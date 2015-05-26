<?php

  if ($channel=="all") {
    $backgroundColor = "yellow";
  }else{
    $backgroundColor = Channel::color($channel);
    $channelName = Channel::description($channel);
  }

?>
<div class="categoriesButton" style="background:{{$backgroundColor}}">

  @if($channel == 'all')
    <h2>Showing All Posts</h2>
    <h3>Tap to Pick a Channel   &rsaquo;</h3>
  @else
    <h2 class="white">{{$channelName}}</h2>
    <h3 class="white">Tap to change channel   &rsaquo;</h3>
  @endif


</div>
