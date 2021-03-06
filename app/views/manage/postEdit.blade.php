@extends('manage.layout')

@section('title')
Edit Post Details
@stop

@section('content')
<a href="/manage/{{$blog->blog_id}}" class="btn btn-default btn-large">&larr; Go Back</a>

<h1>Edit Post Details</h1>

<hr>

<div class="row">

		<div class="col-md-8">
			<form action="/manage/{{$blog->blog_id}}/edit/post/{{$post->post_id}}" method="POST" accept-charset="utf-8" enctype="multipart/form-data" >
				{{Form::token()}}

				<div class="form-group{{ $errors->has('post_title') ? ' has-error' : '' }}">
				    <label for="post_title">Post Title</label>
				    <input type="text" name="post_title" class="form-control" @if(Input::old()) value="{{Input::old('post_title')}}" @else value="{{$post->post_title}}" @endif>
				    <small class="text-danger">{{ $errors->first('post_title') }}</small>
				</div>
			
				<div class="row">
					<div class="form-group col-md-8">
						<label for="post_tags">Post Categories (maximum two)</label>
						<div>
							@foreach (Channel::collection() as $channel)
							<div class="checkbox">
								<label>
									<input name="post_tags[]" type="checkbox" value="{{$channel['name']}}" @if($post->
									hasChannel($channel['name'])) checked @endif>
								  	{{$channel['description']}}
								</label>
							</div>					
							@endforeach
							<small id="maxCategoriesWarning" class="text-danger"></small>
						</div>
					</div>
					<div class="col-md-4 form-group{{ $errors->has('rating_numerator') ? ' has-error' : '' }}">
					    <label for="rating_numerator">Post is a review? What's the rating? (optional)</label>
					    <?php 
					    	if ($post->hasRating()) {
					    		$currentRating = round(($post->rating_numerator / $post->rating_denominator ) * 10);
					    	}else{
					    		$currentRating = null;
					    	}
					    	 
					    ?>
					    <div class="input-group">
						    <input type="text" name="rating_numerator" class="form-control" @if(Input::old()) value="{{Input::old('rating_numerator')}}" @else value="@if ($currentRating) {{$currentRating}} @endif" @endif>
						    <div class="input-group-addon">/ 10</div>
					    </div>
					    <small class="text-danger">{{ $errors->first('rating_numerator') }}</small>
					</div>
				</div>


				<button class="btn btn-primary btn-lg">Submit Changes</button>
				<hr>
				<h3>Danger:</h3>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePost"><i class="fa fa-trash"></i> Delete Post</button>
			</form>
		</div>
		<div class="col-md-4 visible-md visible-lg">
			<img src="{{$post->image()->src}}" class="img-responsive">

			<h3><i class="fa fa-picture-o"></i> Change Your Post Image</h3>
			<form class="dropzone" data-message="Click (or Drag) Here to Add a new Image" method ="POST" action="/manage/uploadPostImage/{{$post->post_id}}" enctype="multipart/form-data">
				{{Form::token()}}
			</form>
		</div>
		
</div>


<!-- Are you Sure? Modal -->
<div id="deletePost" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you sure?</h4>
      </div>
      <div class="modal-body">
        <p>Deleting this post means that you will lose all clicks this post has accumulated so far. <br/>Also, this post may be brought back if you didn't delete it at source</p>
        {{ Form::open(['method' => 'DELETE', 'url' => "/manage/$blog->blog_id/edit/post/$post->post_id"]) }}
        	<button type="submit" class="btn btn-danger">Yes, Delete It</button>
        	<button class="btn" data-dismiss="modal">Cancel</button>
      	{{ Form::close()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


@stop

@section('scripts.footer')
	<script src="/js/management.js"></script>
@stop
