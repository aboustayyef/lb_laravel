<?php
$h = $post->post_image_height;
$w = $post->post_image_width;

if ($post->cacheImage()) {
  $image = $post->cacheImage();
} else {
  $image = $post->post_image;
}

$hue = $post->post_image_hue;
$saturation = '20%';
$luminosity = '85%';
if ($hue == 0) {
  $saturation = '0%';
}

?>
<img
  src="{{ $image }}"
  width="100%"
  height="auto"
  style="background-color:hsl({{ $hue }},{{ $saturation }}, 75%)"
>
