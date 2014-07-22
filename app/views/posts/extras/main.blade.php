{{-- This view handles the routing for the extra cards --}}

@if ($counter == 1)
	{{View::make('posts.extras.topList')}}
@endif

@if ($counter == 5)
	{{View::make('posts.extras.tipFavorites')}}
@endif