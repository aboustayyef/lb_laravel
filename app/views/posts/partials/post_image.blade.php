<?php
$h = $post->post_image_height;
$w = $post->post_image_width;
$width = 278;
$r = $w/278;
$height = $h / $r;
$cachedImageFilename = $post->post_timestamp.'_'.$post->blog_id.'.jpg';
$cachedImage = $_ENV['DIRECTORYTOPUBLICFOLDER'].'/img/cache/'.$post->post_timestamp.'_'.$post->blog_id.'.jpg'; // if exists
if (file_exists($cachedImage)) {
  $image = asset('/img/cache/'.$cachedImageFilename);
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
