<?php
$h = $post->post_image_height;
$w = $post->post_image_width;
$width = 278;
$r = $w/278;
$height = $h / $r;
?>
<img
	class="lazy cardImage" 
	data-original="{{ $post->post_image }}" 
	src="{{ asset('/img/grey.gif') }}" 
	width="{{ $width }}" 
	height="{{ $height }}"
>