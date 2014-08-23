@extends('posts.template')

@section('content')
  <h1>Testing Favorites</h1>
  <?php
    $userID = User::signedIn();
    $user = User::find($userID);
    $user_first_name = $user->first_name;
    $user_last_name = $user->last_name;
  ?>
  <h3>Hello {{$user_first_name}}</h3>
@stop
