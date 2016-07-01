<?php
$h = $post->post_image_height;
$w = $post->post_image_width;

$r = $w/$h;

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
  data-ratio = "{{$r}}"
  class="lazy adjustHeight"
  @if (app('env') == 'staging')
	src="{{ asset('http://static.lebaneseblogs.com/img/transparent.png') }}"
  @else
	src="{{ asset('/img/transparent.png') }}"
  @endif
  data-original="{{ $image }}" 
  style="background-color:hsl({{ $hue }},{{ $saturation }}, 75%)"
>
