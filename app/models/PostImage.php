<?php

class PostImage {
	
	public $exists, $src, $height, $width, $ratio, $background_color;

	public function __construct(Post $post)
	{
		$this->post = $post;

		// Does an image exist?
		if (strlen($this->post->post_local_image) > 0 || ($this->post->post_image_height > 0)) {
		  $this->exists = true;
		} else {
		  $this->exists = false;
		}

		// Image's source
		if ($this->post->cacheImage()) {
		  $this->src = $this->post->cacheImage();
		} else {
		  $this->src = $this->post->post_original_image;
		}

		// Image's dimensions
		if ($this->post->cacheImage()) {
		  $this->height = 165;
		  $this->width = 300;
		} else {
		  $this->height = "auto";
		  $this->width = "100%";
		}

		// Image's Ratio (height / width)
		if ($this->post->post_image_width > 0) {
		  $this->ratio = $this->post->post_image_height / $this->post->post_image_width;
		} else {
		  $this->ratio = false;
		}
		$this->horizontal = $this->post->post_image_width > $this->post->post_image_height;

		// Image's background color
		$hue = $this->post->post_image_hue;
		$saturation = '20%';
		$luminosity = '85%';
		if ($hue == 0) {
		  $saturation = '0%';
		}
		$this->background_color = "hsl($hue, $saturation, 75%)";
	}
}