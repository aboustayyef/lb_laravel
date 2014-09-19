<?php $ourUser = User::find(User::signedIn()) ?>
<div class="noresults">

  @if (Session::get('pageKind') == 'following')
    <img src="{{asset('img/lonely-tree.jpg')}}" alt="Lonely Tree">
    <h2>Hello {{$ourUser->firstName()}}</h2>
    <p>You're not following any blogs yet. Find blogs to follow by browsing all the blogs and clicking on the 'follow' button next to a blog's name</p>
    <a href="{{URL::to('/')}}" class="bigAssRedButton">Start Now</a>
  @endif

  @if (Session::get('pageKind') == 'liked')
    <img src="{{asset('img/bucket-of-hearts.png')}}" width="107" height="auto" alt="Bucket of Hearts">
    <h2>Hello {{$ourUser->firstName()}}</h2>
    <p>You haven't liked any posts yet. To like posts, just click on the like button under posts that inspire you</p>
    <a href="{{URL::to('/')}}" class="bigAssRedButton">Start Now</a>
  @endif

</div>
