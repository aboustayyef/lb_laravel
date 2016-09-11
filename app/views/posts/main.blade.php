@extends('posts.template')

@section('content')
{{-- Show a message if one exists --}}

  @if (Session::has('lbMessage'))
    @include('posts.partials.helloWindow')
  @endif


@if ((count($initialPosts) < 20) || (Session::get('pageKind') == 'searchResults'))
  <script>lbApp.reachedEndOfPosts = true</script>
@endif

  @if (!is_object($initialPosts))
    <div id ="posts" class= "ut__inner"> 
      {{View::make('posts.extras.noresults')}}
    </div>
  @endif


  {{-- Render the first batch of posts --}}
    @if(is_object($initialPosts))
      <div id ="posts" class= "ut__inner"> <!-- cards is default -->

          @include('posts.render', array(
            'posts'=>$initialPosts ,
            'from'=>0,
            'to'=>20))
            
      </div>
    @endif
@stop
