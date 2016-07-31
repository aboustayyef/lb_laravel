@extends('manage.layout')

@section('title')
Edit Blog Details
@stop

@section('content')
<a href="/manage/{{$blog->blog_id}}" class="btn btn-default btn-large">&larr; Go Back</a>

<h1>Edit Blog Details</h1>
<hr>

<div class="row">

	<form action="/manage/{{$blog->blog_id}}/edit/blog" method="POST" accept-charset="utf-8" enctype="multipart/form-data" >
		<div class="col-md-8">
			{{Form::token()}}

			<div class="form-group{{ $errors->
				has('blog_name') ? ' has-error' : '' }}">
				<label for="blog_name">Name of Blog</label>
				<input type="text" name="blog_name" class="form-control" @if(Input::old()) value="{{Input::old('blog_name')}}" @else value="{{$blog->
				blog_name}} @endif ">
				<small class="text-danger">{{ $errors->first('blog_name') }}</small>
			</div>

			<div class="form-group{{ $errors->
				has('blog_author') ? ' has-error' : '' }}">
				<label for="blog_author">Name of Author (Leave empty if you want to remain anonymous)</label>
				<input type="text" name="blog_author" class="form-control" @if(Input::old()) value="{{Input::old('blog_author')}}" @else value="{{$blog->
				blog_author}}" @endif>
				<small class="text-danger">{{ $errors->first('blog_author') }}</small>
			</div>

			<div class="form-group{{ $errors->
				has('blog_description') ? ' has-error' : '' }}">
				<label for="blog_description">Blog Description</label>
				<textarea name="blog_description" class="form-control">@if(Input::old()){{Input::old('blog_description')}} @else{{$blog->blog_description}}@endif</textarea>
				<small class="text-danger">{{ $errors->first('blog_description') }}</small>
			</div>

			<div class="form-group">
				<label for="blog_author_twitter_username">
					Associated Twitter Account (Please contact admin if you want to change this)
				</label>
				<input type="text" name="blog_author_twitter_username" class="form-control" value="{{$blog->blog_author_twitter_username}}" disabled>
			</div>

			<h3>Blog Default Categories (maximum two)</h3>
			
			<div class="form-group">
				<div class="checkbox">
					@foreach (Channel::collection() as $channel)
					<div class="checkbox">
						<label>
							<input name="blog_tags[]" type="checkbox" value="{{$channel['name']}}" @if($blog->
							hasChannel($channel['name'])) checked @endif>
						  	{{$channel['description']}}
						</label>
					</div>
					@endforeach
					<small id="maxCategoriesWarning" class="text-danger"></small>

				</div>
			</div>
			<button class="btn btn-primary">Submit</button>
			<hr style="visibility:hidden">
		</div>
	</form>

	<div class="col-md-4">
		<img src="/img/thumbs/{{$blog->blog_id}}.jpg" width="100" height="100" alt="" class="img-thumbnail img-responsive">
		<h3>Change Your Avatar</h3>
		<form class="dropzone" method ="POST" action="/manage/uploadBlogAvatar/{{$blog->blog_id}}" enctype="multipart/form-data">
			{{Form::token()}}
		</form>
	</div>

</div>
@stop
@section('scripts.footer')
	<script src="/js/management.js"></script>
@stop


