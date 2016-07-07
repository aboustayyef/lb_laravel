<div id="channelPicker">
  {{--Request::path()--}}
<div class="ut__inner ut__space_between">

  {{-- We use a Selector for mobile only --}}
  <select name="channelSelector" id="channelSelector">
    @if(Request::path() == 'posts/all')
      <option >Pick A Channel</option>
    @else
      <option data-target="{{URL::to('/posts/all')}}">Show All</option>
    @endif
    @foreach (Channel::$list as $channel)
      <option data-target="{{URL::to('/posts/'.$channel['name'])}}" @if(strpos(Request::path(), $channel['name'])) selected="selected" @endif>
        {{$channel['description']}}
      </option>
    @endforeach
  </select>


  <label id="openLinksInNewTabs" class="ios7-switch">
      <span class="lbl">Open Links in New Tabs</span>
      <input id="newtabs" type="checkbox" checked>
      <span></span>
  </label>

</div> {{-- inner --}}

</div> {{-- channelPicker --}}