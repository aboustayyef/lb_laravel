<div class="post_wrapper no_min">
  <?php $randomKey = rand(1,4); ?>
  <div class="card no_color no_border no_min">
    @if ($randomKey == 1)
      <img src="{{asset('img/poster_favorites.png')}}" width="300" height="300" alt="">
    @elseif ($randomKey == 2)
      <img src="{{asset('img/poster_saved.png')}}" width="300" height="300" alt="">
    @elseif ($randomKey == 3)
      <img src="{{asset('img/poster_twitter.png')}}" width="300" height="300" alt="">
    @elseif ($randomKey == 4)
      <img src="{{asset('img/poster_edit_your_blog.png')}}" width="300" height="300" alt="">
    @endif
  </div>
</div>
