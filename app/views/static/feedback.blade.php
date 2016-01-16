@extends('static.template')
@section('content')

<h2>Submit Feedback To Lebanese Blogs</h2>
<style>
  p{
    line-height: 1.5;
    font-size: 18px;
  }
  a.button{
    background:#b12530;
    color:white;
    padding:8px;
    border-radius:3px;
    display:inline-block;
    border:1px solid #b12530;
  }
  a.button:hover{
    color:#b12530;;
    background:white;
  }
  p.understated{
    font-size:16px;
    color:#999;
  }
</style>
<p>The best way to submit feedback to Lebanese Blogs is to send us a message on our Facebook page</p>
<p>
  <a href="https://www.facebook.com/lebaneseblogs/" class="button">
    Send Us a Message Now
  </a>
</p>

<p class="understated">It typically takes us less than 24 hours to respond. Be frank, don't hold anything back. We want to improve</p>

@stop
