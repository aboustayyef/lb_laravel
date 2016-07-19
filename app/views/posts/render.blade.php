{{-- Start The Loop --}}

@foreach ($posts as $post)

<?php
  // sometimes blogs relating to posts no longer exist. In that case, we skip..
  if (!is_object($post->blog)) {
    Session::set('postsCounter', Session::get('postsCounter') + 1);
    continue;
  }

  // handle extra cards like welcome message, countdown lists & tips

  echo View::make('posts.extras.main')->with('counter', Session::get('cardsCounter'))->render();

?>

<?php
  // get blogger data
  $blog = $post->blog;

  // increase load count
  // $post->increaseCount();
?>
  @include ('posts.card')


<?php
  // update Posts Counter and Card Counter.
  Session::set('cardsCounter', Session::get('cardsCounter') + 1);
  Session::set('postsCounter', Session::get('postsCounter') + 1);
?>

@endforeach
