<?php

if ($post->cacheImage()) {
  $image = $post->cacheImage();
} else {
  $image = $post->image()->src;
}

?>
<a href="{{$post->exitLink()}}">
<div class="image" style="background-color:{{$post->image()->background_color}};background-image:url({{ $image }}) ;padding-top:55%">
  </div>
</a>