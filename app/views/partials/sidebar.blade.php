<div id="sidebar">

  <div id="scroller">
  <?php $ourUser = User::find(User::signedIn()) ?>

    <div id="channels">
      <div class="close">
        <img src="{{asset('/img/close-button.png')}}" alt="">
      </div>
      <h3>Search Thousands of Posts</h3>
      <div class="searchform">
        {{Form::open(array( 'url' => 'posts/search', 'method' =>  'get' )) }}

        {{Form::text('q')}}
        {{Form::submit('Find')}}
        {{ Form::close() }}
      </div>
      <h3>Filter Posts By Topics</h3>
      <?php $currentChannel = Session::get('channel'); ?>
      <ul>
        @if ($currentChannel != 'all')
          <li class ="showAll categoryButton dynamicLink" data-destination="{{URL::to('/posts/all')}}">
            <i class="fa fa-th"></i> Show All Posts
          </li>
        @endif

        @foreach (Channel::$list as $channel)
        <li class ="categoryButton dynamicLink" data-destination="{{URL::to('/posts/'.$channel['name'])}}"
        <?php if (!in_array(Session::get('pageKind'), ['favorites', 'saved', 'search'])): ?>
          @if($channel['name'] == $currentChannel)
            style="background: {{$channel['color']}}"
          @else
            style="border-left: solid 3px {{$channel['color']}}"
          @endif
        <?php endif; ?>
        >
          <i class ="fa {{$channel['icon']}}"></i> {{$channel['description']}}
        </li>
        @endforeach
      </ul>
    </div>
      <div class="credits">
        Lebanese Blogs Designed &amp; Built by
        <br>
        <a href="http://twitter.com/beirutspring">Mustapha Hamoui -<?php echo date('Y') ?></a>
      </div>
  </div>
</div>
