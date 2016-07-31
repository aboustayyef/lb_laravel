{{-- This view handles the routing for the extra cards --}}

<?php
  $pageKind = Session::get('pageKind');
  $counter = Session::get('cardsCounter');
?>

@if ($counter == 0)

  @if ($pageKind == 'blogger')
    @include('posts.extras.bloggerInfo')
    <?php Session::set('cardsCounter', Session::get('cardsCounter') + 1); ?>

  @elseif ($pageKind == 'channel')
    @include('posts.extras.channelInfo')
    <?php Session::set('cardsCounter', Session::get('cardsCounter') + 1); ?>

  @elseif ($pageKind == 'searchResults')
    @include('posts.extras.searchResults')
    <?php Session::set('cardsCounter', Session::get('cardsCounter') + 1); ?>

  @endif
@endif

@if ($counter == 0)

  @include('posts.extras.popular')
  <?php Session::set('cardsCounter', Session::get('cardsCounter') + 1); ?>

@endif

@if ($counter == 11)
  {{View::make('posts.extras.news')->with('source','naharnet')}}
  <?php
      Session::set('cardsCounter', Session::get('cardsCounter') + 1);
  ?>
@endif



@if (false); {{-- previously: in_array($counter, [6,14,29,44, 59]) --}}
  @include('posts.extras.adsense1')
  <?php
      Session::set('cardsCounter', Session::get('cardsCounter') + 1);
  ?>
@endif
