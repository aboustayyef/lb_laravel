<?php $ourUser = User::find(User::signedIn()) ?>

  <div id="userTools" class="card no_min <?php if (session::get('pageKind') == 'allPosts') echo 'push_down' ?>">
    <div class="userHeader">
      <img src="{{$ourUser->profileImage()}}" alt="">
      <h2>Hello {{$ourUser->firstName()}}!</h2>
      <div class="signout">
        <i class="fa fa-sign-out"></i><a href="{{URL::to('/logout')}}">Sign Out</a>
      </div>
    </div>
    <div class="info">
      <ul class="userNavigation">
        <a href="/user/following"><li <?php if (session::get('pageKind') == 'following') echo 'class="active"' ?>><i class="fa fa-check"></i>Your Follows</li></a>
        <a href="/user/liked"><li <?php if (session::get('pageKind') == 'liked') echo 'class="active"' ?>><i class="fa fa-heart"></i>Your Likes</li>
        <a href="/posts/all"><li <?php if (session::get('pageKind') == 'allPosts') echo 'class="active"' ?>><i class="fa fa-th"></i>All Blogs</li></a>
      </ul>
    </div>
  </div>
