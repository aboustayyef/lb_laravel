{{-- This view handles the routing for the extra cards --}}


@if ($counter == 0)
  <?php
    $pageKind = Session::get('pageKind');
  ?>

  @if ($pageKind == 'blogger')
    @include('posts.extras.topBloggerList')
    <?php Session::set('cardsCounter', Session::get('cardsCounter') + 1); ?>

  @elseif ($pageKind == 'following')
    <div class="post_wrapper"> <!-- on its own, not part of top list -->
      @include('posts.extras.user')
    </div>
    <?php Session::set('cardsCounter', Session::get('cardsCounter') + 1); ?>

  @elseif ($pageKind == 'searchResults')
    @include('posts.extras.searchResults')
    <?php Session::set('cardsCounter', Session::get('cardsCounter') + 1); ?>

  @elseif ($pageKind == 'liked')
    <div class="post_wrapper"> <!-- on its own, not part of top list -->
      @include('posts.extras.user')
    </div>
    <?php Session::set('cardsCounter', Session::get('cardsCounter') + 1); ?>

  @elseif ($pageKind == 'search')
    {{-- Nothing yet --}}



  @else
    @include('posts.extras.topList')
    <?php Session::set('cardsCounter', Session::get('cardsCounter') + 1); ?>
  @endif
@endif

@if ($counter == 9)
  @include('posts.extras.961mag')
  <?php
      Session::set('cardsCounter', Session::get('cardsCounter') + 1);
  ?>
@endif

@if ($counter == 6)
  @include('posts.extras.tips')
  <?php
      Session::set('cardsCounter', Session::get('cardsCounter') + 1);
  ?>
@endif

@if ($counter == 11)
  @include('posts.extras.news')
  <?php
      Session::set('cardsCounter', Session::get('cardsCounter') + 1);
  ?>
@endif
