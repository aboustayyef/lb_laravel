{{-- This view handles the routing for the extra cards --}}

@if ($counter == 1)
  <?php
    if ((Session::has('pageKind')) && (Session::get('pageKind') == 'blogger')) {
      echo View::make('posts.extras.topBloggerList');
    }else{
      echo View::make('posts.extras.topList');
    }
  ?>
@endif

@if ($counter == 5)
	{{View::make('posts.extras.tipFavorites')}}
@endif
