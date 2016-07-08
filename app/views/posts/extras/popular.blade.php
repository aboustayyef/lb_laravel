
<?php
	$topPosts = Post::topPosts();
?>

<div id = "top_posts" class="card card--double">
	<div class="top_posts__content top_posts__left">
		<h3 class="top_posts__header">
			Top Posts
		</h3>
		<p class="top_posts__about">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto laboriosam necessitatibus soluta quaerat quo temporibus.
		</p>
	</div>
	<div class="top_posts__content top_posts__right">
	<ul>
		@foreach ($topPosts as $post)
			<li class="top_posts__item">
				<div class="top_posts__thumb">
					<?php $i = $post->image(); ?>
					@if($i->exists)
						<a class="exitLink" href="">
						@if($i->horizontal)
							<img class="lazy" src="/img/transparent.png" data-original="{{$i->src}}" height = "60px" width="{{60/$i->ratio}}px" alt="">
						@else
							<img class="lazy" src="/img/transparent.png" data-original="{{$i->src}}" width = "60px" height="{{60*$i->ratio}}px" alt="">
						@endif
						</a>
					@endif
				</div>
				<div class="top_posts__details">
					<a class="top_posts__title exitLink" href="">{{str_limit($post->post_title, 60)}}</a>
					<p class="top_posts__blog">{{$post->blog->blog_name}}</p>
				</div>
				
			</li>
		@endforeach
	</ul>
	</div>
</div>