
<?php
	$topPosts = Post::topPosts();
?>

<div class="card card--double card--transparent ut__MobileOnly" style="height:auto">
	<h3 class="top_posts__header top_posts__header--mobile">
		Top Posts
	</h3>
</div>

<div id = "top_posts" class="card card--double">
	<div class="top_posts__content top_posts__left">
		<div>
			<h3 class="top_posts__header">
				Top Posts
			</h3>

			<p class="top_posts__about">
				{{Page::topPostsDescription()}}
			</p>
		</div>
		<div>
			Questions? Contact @beirutspring
		</div>
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
					<a class="top_posts__title exitLink" href="{{$post->exitLink()}}">{{str_limit($post->post_title, 60)}}</a>
					<p class="top_posts__blog">{{$post->blog->blog_name}}</p>
				</div>
				
			</li>
		@endforeach
	</ul>
	</div>
</div>

<div class="card card--double card--transparent ut__MobileOnly" style="height:auto">
	<h3 class="top_posts__header top_posts__header--mobile">
		Recent Posts
	</h3>
</div>
