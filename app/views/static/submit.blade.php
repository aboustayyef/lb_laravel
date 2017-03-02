@extends('static.template')
@section('content')


<style>
    a.button{
    margin-top:2em;
    background:#b12530;
    color:white;
    padding:1em 2em;
    border-radius:3px;
    display:inline-block;
    border:1px solid #b12530;
  }
  a.button:hover{
    color:#b12530;;
    background:white;
  }
</style>

<h1>Submit Your Blog</h1>

<h2>Requirements</h2>
<h4 style="font-weight:bold;margin-bottom:2em">Before you submit a blog, make sure it fulfills the following criteria:</h4>
<ul class="criteria">
  <li>The author has to be either Lebanese, living in Lebanon or writing about Lebanon</li>
  <li>The blog should be at least 6 months old</li>
  <li>The blog should be personal, not commercial or institutional</li>
  <li>The blog should not be a vehicle for ads or spam in the posts</li>
</ul>


<a class="button" href="https://submit.lebaneseblogs.com">Submit</a>


@stop
