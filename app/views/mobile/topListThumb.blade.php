<?php
if ($post->image()->exists) {
	$h = $post->post_image_height;
	$w = $post->post_image_width;

	$width = 60;
	$r = $w/60;
	$height = $h / $r;

  if ($post->cacheImage()) {
    $image = $post->cacheImage();
  } else {
    $image = $post->post_image;
  }
  ?>
  @if ($height > $width)
	<img data-original="{{$image}}" class="lazy" style="background: #F3E7E8" src="{{ asset('/img/transparent.png') }}" width="60px" height="auto" alt="">
	@else
	<img data-original="{{$image}}" class="lazy" style="background: #F3E7E8" src="{{ asset('/img/transparent.png') }}" height="60px" width="auto" alt="">
  @endif
  <?php
} else {
    $image = asset('/img/no_image.png');
    ?>
    <img data-original="{{$image}}" class="lazy" style="background: #F3E7E8" src="{{ asset('/img/transparent.png') }}" width="60px" height="60px" alt="">
    <?php
}?>