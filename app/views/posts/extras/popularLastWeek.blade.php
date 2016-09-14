<div class="card card--double card--square">
	<div class="miniCardsCollection">
	<h3 class="top_posts__header">
		Popular Posts Last Week
	</h3>
	<div class="top_posts__minicards">
		<div class="minicards_wrapper">		
			<?php $miniposts = Post::orderBy('post_timestamp', 'desc')->take(5)->get(); ?>
			@foreach ($miniposts as $minipost)
				<div class="miniCard">
					@if ($minipost->image()->exists)
						<div class="miniImageWrapper">
							<img style="background: #F3E7E8" src="{{$minipost->image()->src}}" width="176" height="96.8" >
						</div>
					<div class="miniCard__meta">
						<h2 class="minipost__title">
							<a href="#">{{$minipost->post_title}}</a>
						</h2>
						<a href="">
				          <img style="background: #F3E7E8" class="blog__thumbnail" src="/img/transparent.png" data-original="/img/thumbs/{{$minipost->blog_id}}.jpg"  width="40px" height="40px">
				        </a>
					</div>
					@endif
				</div>
			@endforeach
		</div>
	</div>
		
	</div>
</div>