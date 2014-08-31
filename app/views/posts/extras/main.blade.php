{{-- This view handles the routing for the extra cards --}}

@if ($counter == 1)
  <?php
    $pageKind = Session::get('pageKind');
    if ((!empty($pageKind)) && ($pageKind == 'blogger')) {
      echo View::make('posts.extras.topBloggerList');
    }elseif (in_array($pageKind, ['search','favorites','saved'])){
      #don't show top posts for kinds in that array
    } else{
      echo View::make('posts.extras.topList');
    }
  ?>
@endif

@if ($counter == 2)
  <?php
      echo View::make('posts.extras.flip3dTest');
  ?>
@endif
