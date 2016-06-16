@extends('posts2.layout')

@section('headScript')
<!-- Initialize App Object -->
<script>
    lbApp = {
    	posts_wrapper: 'posts', 		// The div within which posts are wrapped 
        channel: "{{$channel}}",		// The channel, loaded from route
        posts:0,						// The Number of posts loaded
        cards:0,						// The Number of cards loaded (posts + extras)
        posts_per_load: 15,				// how many posts does each refresh load
    }
    console.log(lbApp);
</script>
@stop

@section('title')
	This is the title
@stop

@section('description')
	This is the description
@stop

@section('content')
	<div id="posts">
		<div class="card">
			test
		</div>
	</div>
	No Content Yet; <!-- replace with spinning wheel -->
@stop