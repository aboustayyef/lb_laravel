@extends('posts.template')

@section('content')
  @if (Session::has('channel'))
    @if (Session::get('channel') != 'all')
    <div class="currentChannel" style="background: {{Channel::color(Session::get('channel'))}}">
      <i class="fa fa-times-circle"></i>
      {{Channel::description(Session::get('channel'))}}
    </div>
    @endif
  @endif
    <div class="posts cards"> <!-- cards is default -->
      @include('posts.render', array(
        'posts'=>$posts ,
        'from'=>0,
        'to'=>20))
    </div>
@stop
