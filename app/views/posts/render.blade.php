<?php

  // we reinstantiate the user object each time because
  // this page is requested from ajax with access to session variables only

  $ourUser = User::signedIn();
  if ($ourUser) {
    $ourUser = User::find($ourUser);
  }
?>

{{-- Start The Loop --}}

@foreach ($posts as $post)

<?php
  // handle extra cards like welcome message, countdown lists & tips
  echo View::make('posts.extras.main')->with('counter', Session::get('cardsCounter'));
?>

<?php
  // get blogger data
  $blog = $post->blog;
?>
  @include ('posts.card')


<?php
  // update Posts Counter and Card Counter.
  Session::set('cardsCounter', Session::get('cardsCounter') + 1);
  Session::set('postsCounter', Session::get('postsCounter') + 1);
?>

@endforeach
