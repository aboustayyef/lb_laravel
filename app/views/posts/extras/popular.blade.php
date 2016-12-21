
<?php
	$topPosts = Post::topPosts();
?>

<div class="card card--double card--transparent ut__MobileOnly" style="height:auto">
	<h3 class="top_posts__header top_posts__header--mobile">
		Top Posts Right Now<a class="top_posts__showMore closed" href="#"></a>
	</h3>
</div>

<div id = "top_posts" class="closed card card--double">
	<div class="top_posts__content top_posts__left">
		<div>
			<h3 class="top_posts__header nopadding">
				Top Posts
			</h3>

			<p class="top_posts__about">
				<?php 
				    $pagekind = Session::get('pageKind');
			    ?>

			      @if ((empty($pagekind)) || ($pagekind == 'allPosts')) 
			        These are recent posts that our users have found most interesting and shareworthy
			      @endif

			      @if ($pagekind == 'channel') 
			        <?php $channelDescription = Channel::description(Session::get('channel')); ?>
			        These are recent {{$channelDescription}} posts that our users have found most interesting and shareworthy
			      @endif

			      @if ($pagekind == 'blogger') 
			        <?php
				        $bloggerDetails = Blog::find(Session::get('blogger'));
				        $blogName = $bloggerDetails->blog_name;
			        ?>
			        Recent popular posts by {{$blogName}}
			      @endif
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
						<a class="exitLink" href="{{$post->exitLink()}}" rel="nofollow">
						@if($i->horizontal)
							<img class="lazy" src="/img/transparent.png" data-original="{{$i->src}}" height = "60px" width="{{60/$i->ratio}}px" alt="">
						@else
							<img class="lazy" src="/img/transparent.png" data-original="{{$i->src}}" width = "60px" height="{{60*$i->ratio}}px" alt="">
						@endif
						</a>
					@endif
				</div>
				<div class="top_posts__details">
					<a class="top_posts__title exitLink" href="{{$post->exitLink()}}" rel="nofollow">{{str_limit($post->post_title, 60)}}</a>
					<p class="top_posts__blog">{{$post->blog->blog_name}}</p>
				</div>
				
			</li>
		@endforeach
	</ul>
	</div>
</div>

