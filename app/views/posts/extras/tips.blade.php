<div class="post_wrapper no_min">
  <?php $randomKey = rand(1,3); ?>

  @if ($randomKey == 1)
    <img src="{{asset('img/poster_favorites.png')}}" width="300" height="300" alt="">
  @elseif ($randomKey == 2)
    <img src="{{asset('img/poster_saved.png')}}" width="300" height="300" alt="">
  @elseif ($randomKey == 3)
    <img src="{{asset('img/poster_twitter.png')}}" width="300" height="300" alt="">
  @endif

</div>
