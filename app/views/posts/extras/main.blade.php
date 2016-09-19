{{-- This view handles the routing for the extra cards --}}

@if (current_card() == 0)

  @if (page_is_blogger())
    @include('posts.extras.bloggerInfo')
    @include('posts.extras.popular')
    <?php increase_card_count(2); ?>

  @elseif (page_is_channel())
    @include('posts.extras.channelInfo')
    @include('posts.extras.popular')
    <?php increase_card_count(2); ?>

  @elseif (page_is_search())
    @include('posts.extras.searchResults')
    <?php increase_card_count(1); ?>

  @else
    @include('posts.extras.popular')
    <?php increase_card_count(1); ?>
  @endif


@endif

@if (current_card() == 7)
  @if(page_is_main())
    <?php $ppp = new PopularPreviousPosts('week') ?>
    @if($ppp->ok)
      @include('posts.extras.popularLastWeek')
      <?php increase_card_count(1); ?>
    @endif
  @endif
@endif

@if (current_card() == 12)
  @if(page_is_main())
    <?php $ppp = new PopularPreviousPosts('month') ?>
    @if($ppp->ok)
      @include('posts.extras.popularLastWeek')
      <?php increase_card_count(1); ?>
    @endif
  @endif
@endif

@if (current_card() == 17)
  @if(page_is_main())
    <?php $ppp = new PopularPreviousPosts('year') ?>
    @if($ppp->ok)
      @include('posts.extras.popularLastWeek')
      <?php increase_card_count(1); ?>
    @endif
  @endif
@endif

{{-- @if (current_card() == 8 )
  @include('posts.extras.lebtivity')
@endif --}}

