{{-- This view handles the routing for the extra cards --}}

<?php
  $pageKind = Session::get('pageKind');
  $counter = Session::get('cardsCounter');
?>

@if ($counter == 0)

  @if ($pageKind == 'blogger')
    @include('posts.extras.bloggerInfo')
    @include('posts.extras.popular')
    <?php Session::set('cardsCounter', Session::get('cardsCounter') + 2); ?>

  @elseif ($pageKind == 'channel')
    @include('posts.extras.channelInfo')
    @include('posts.extras.popular')
    <?php Session::set('cardsCounter', Session::get('cardsCounter') + 2); ?>

  @elseif ($pageKind == 'searchResults')
    @include('posts.extras.searchResults')
    <?php Session::set('cardsCounter', Session::get('cardsCounter') + 1); ?>

  @else
    @include('posts.extras.popular')
    <?php Session::set('cardsCounter', Session::get('cardsCounter') + 1); ?>
  @endif


@endif

@if ($counter == 6)
  @include('posts.extras.popularLastWeek')
  <?php 
    Session::set('cardsCounter', Session::get('cardsCounter') + 1); 
  ?>
@endif

