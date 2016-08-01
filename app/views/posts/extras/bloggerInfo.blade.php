<div id = "blogger_info" class="card card--fullWidth card--transparent ut__flexWrapper">

<img src="/img/thumbs/{{$blog->blog_thumb}}.jpg" alt="Blogger Thumbnail" class="blogger__thumb">

<h1 class="pageKind__title">
	{{$blog->blog_name}}
</h1>

@if(Session::has('SignedInBlogger'))
	@if(Session::get('SignedInBlogger')->canManage($blog->blog_id))

		<div class="ut__Valign">
			<a href="/manage/{{$blog->blog_id}}" class="blogger__manage">Manage this blog</a>
		</div>

		@if(!$blog->isActive())
			<div class="ut__Valign">
				<h2 class="pageKind__warning">Warning: Blog is not active. Reason: {{$blog->reason_for_deactivation}}.<br>Get In Touch with Admin To Reactivate</h1>	
			</div>
		@endif

	@endif
@endif
</a>

</div>
