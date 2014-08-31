@extends('posts.template')

@section('content')
  @if (Session::has('channel'))
    @if (Session::get('channel') != 'all')
    <?php if (!in_array(Session::get('pageKind'), ['favorites', 'saved', 'search'])): ?>
      <div class="currentChannel" style="background: {{Channel::color(Session::get('channel'))}}">
        <span class="close dynamicLink" data-destination="{{URL::to('/posts/all')}}"><a href ="#">&times;</a></span>
        {{Channel::description(Session::get('channel'))}}
      </div>
    <?php endif; ?>
    @endif
  @endif

    @include('posts.partials.helloWindow')

    <div class="posts cards"> <!-- cards is default -->
      @include('posts.render', array(
        'posts'=>$posts ,
        'from'=>0,
        'to'=>20))
    </div>
@stop
