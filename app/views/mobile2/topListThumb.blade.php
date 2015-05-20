<?php
$height = $post->post_image_height;
$width = $post->post_image_width;

if ($post->hasImage()) {
  if ($post->cacheImage()) {
    $image = $post->cacheImage();
  } else {
    $image = $post->post_image;
  }
} else {
    $image = asset('/img/no_image.png');
}?>
@if ($height > $width)
<img src="{{$image}}" width="40px" height="auto" alt="">
@else
<img src="{{$image}}" height="40px" width="auto" alt="">
@endif
