<div id="channelPicker">
  {{--Request::path()--}}
<div class="inner">

  {{-- We use a Selector for mobile only --}}
  <select name="channelSelector" id="channelSelector">
    @if(Request::path() == 'posts/all')
      <option >Pick A Channel</option>
    @else
      <option data-target="{{URL::to('/posts/all')}}">Show All</option>
    @endif
    @foreach (Channel::$list as $channel)
      <option data-target="{{URL::to('/posts/'.$channel['name'])}}" @if(strpos(Request::path(), $channel['name'])) selected="selected" @endif>
        <?php fontAwesomeToSvg::convert($channel['icon']); ?> {{$channel['description']}}
      </option>
    @endforeach
  </select>


  {{-- If we have a large screen --}}
  <ul class="channelBar">
    @if(!(Request::path() == 'posts/all'))
      <li>
        <a href="/posts/all">
          Show All
        </a>
      </li>
    @else
      <li class = "chooseACategory">
        Sections :
      </li>
    @endif

  @foreach (Channel::$list as $channel)

    <li
    <?php
      if (strpos(Request::path(), $channel['name'])) {
        echo 'class="active"';
        echo 'style="background-color:'.$channel['color'].'"';
      }
    ?>
    >
      <a href="{{URL::to('/posts/'.$channel['name'])}}">
        <?php fontAwesomeToSvg::convert($channel['icon']); ?> <span class="channelDesc">{{$channel['description']}}</span>
      </a>
    </li>

  @endforeach
  </ul>

</div> {{-- inner --}}

</div> {{-- channelPicker --}}
