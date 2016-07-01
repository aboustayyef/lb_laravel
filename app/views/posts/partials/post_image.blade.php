<?php
$h = $post->post_image_height;
$w = $post->post_image_width;
$width = 300;
$r = $w/$width;
$height = $h / $r;

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
	class="lazy cardImage"
	data-original="{{ $image }}"
	src="{{ asset('/img/transparent.png') }}"
	width="{{ $width }}"
	height="{{ $height }}"
  style="background-color:hsl({{ $hue }},{{ $saturation }}, 75%)"
>
