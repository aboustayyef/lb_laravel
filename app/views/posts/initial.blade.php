@extends('posts.page')
@section('postsInitial')
    <ul>
      @include('posts.render', array('posts', $posts));
    </ul>
@stop