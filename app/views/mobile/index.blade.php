@extends('mobile.layout')

@section('content')

{{-- recent posts (3) --}}

@for($i=0; $i<3; $i++)
  <?php $post = $recentPosts[$i] ;?>

  {{$post->post_title}}<br>

@endfor

{{-- top posts 5--}}

{{-- recent  --}}

@stop
