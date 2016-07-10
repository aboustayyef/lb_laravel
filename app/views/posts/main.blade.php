@extends('posts.template')

@section('content')
{{-- Show a message if one exists --}}

  @if (Session::has('lbMessage'))
    @include('posts.partials.helloWindow')
  @endif


  <?php
    
    // if we have less than 20 initial posts, we disable infinite scrolling
    if (count($initialPosts) < 20) {
      echo '<script>lbApp.reachedEndOfPosts = true</script>';
    }

    // if we don't have any initial posts, we return the relevant "no results" page
    if (!$initialPosts) {
      echo View::make('posts.extras.noresults');
    }
  ?>


  {{-- Render the first batch of posts --}}
    @if($initialPosts)
      <div id ="posts" class= "ut__inner"> <!-- cards is default -->

          @include('posts.render', array(
            'posts'=>$initialPosts ,
            'from'=>0,
            'to'=>20))
            
      </div>
    @endif
@stop
