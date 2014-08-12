<?php
$h = $post->post_image_height;
$w = $post->post_image_width;
$width = 278;
$r = $w/278;
$height = $h / $r;

$currentPost = new Post;
$currentPost = $currentPost->find($post->post_id);

if ($currentPost->cacheImage()) {
  $image = $currentPost->cacheImage();
} else {
  $image = $post->post_image;
}

?>
<img
	class="lazy cardImage"
	data-original="{{ $image }}"
	src="{{ asset('/img/grey.gif') }}"
	width="{{ $width }}"
	height="{{ $height }}"
>
