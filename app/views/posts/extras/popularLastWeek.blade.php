<div id="popularPostsLastWeek" class="card">
	<div class="miniCardsCollection">
	<h3 class="top_posts__header">
		{{$ppp->title}}
	</h3>
	<div class="top_posts__minicards">
		<div class="minicards_wrapper">		
			@foreach ($ppp->listOfPosts as $minipost)
				<div class="miniCard">

					{{-- Image --}}
					@if ($minipost->image()->exists)
						<a class="exitLink" href="{{$minipost->post_url}}" rel="nofollow" onclick="ga('send', 'event', 'Exit Link', 'Card Posts' , '{{$minipost->blog->blog_name}}')">
						  <div data-bg="{{ $minipost->image()->src }}" class="lazy" style="background-color:{{$minipost->image()->background_color}}; background-size:100%; ;padding-top:55%;     background-repeat: no-repeat; border-bottom:1px solid #ececec">
						    </div>
						</a>
					@endif

					<div class="miniCard__meta">
						{{-- Title  --}}
						<h2 class="minipost__title @if(!$minipost->image()->exists) headline_no_image  @endif">
						  <a class="exitLink" href="{{$minipost->post_url}}" rel="nofollow" onclick="ga('send', 'event', 'Exit Link', 'Card Posts' , '{{$minipost->blog->blog_name}}')">
						    {{str_limit($minipost->post_title, 80)}} 
						  </a>
						</h2>
						
						{{-- Thumb and blogname --}}
						<div class="ut__flexWrapper blog__meta">
							<a href="{{url('/blogger/'.$minipost->blog_id)}}">
							<img
								  style="background: #F3E7E8"
								  class="lazy blog__thumbnail"
								  @if (app('env') == 'staging')
								    src="{{ asset('http://static.lebaneseblogs.com/img/transparent.png') }}"
								    data-original="http://static1.lebaneseblogs.com/{{$minipost->blog->blog_thumb.'.jpg'}}"
								  @else
								    src="{{ asset('/img/transparent.png') }}"
								    data-original="{{asset('/img/thumbs/'.$minipost->blog->blog_thumb.'.jpg')}}"
								  @endif
								  alt="{{$minipost->blog->blog_name }} thumbnail"
								  width ="40px" height="40px"
								>
					        </a>
					        <div class="blog__name">
					          <a href="{{url('/blogger/'.$minipost->blog_id)}}">
					            {{ $minipost->blog->blog_name }}
					          </a>
					        </div>
					    </div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
	<small>Scroll for more >></small>
	
	</div>
</div>