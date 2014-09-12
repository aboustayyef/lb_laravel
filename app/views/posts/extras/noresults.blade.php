<?php $ourUser = User::find(User::signedIn()) ?>
<div class="noresults">

  @if (Session::get('pageKind') == 'following')
    <img src="{{asset('img/lonely-tree.jpg')}}" alt="Lonely Tree">
    <h2>Hello {{$ourUser->firstName()}}</h2>
    <p> It's a bit lonely here don't you think? Find blogs to follow by browsing {{link_to('/posts/all', 'all our blogs')}}</p>
  @endif
</div>
