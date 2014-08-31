{{-- **************************** --}}
{{-- Top 5 list of blogger posts  --}}
{{-- **************************** --}}

<?php
$blog = Session::get('blogger');
$blogName = Blog::where('blog_id',$blog)->first()->blog_name;
$posts = Post::getTopPostsByBlogger($blog);
?>

<div class="post_wrapper toplist">
  <h2>Top Posts</h2>
  <h3 class="category">By {{$blogName}}</h3>
  <ul>
    @foreach ($posts as $post)
    <li>
      <div class="item">
        <div class="thumb">
          <a href ="{{$post->post_url}}">
            {{View::make('images.topListThumb')->with('post',$post)}}
          </a>
        </div>
        <div class="details">
          <a href="{{$post->post_url}}"><h3>{{$post->post_title}}</h3></a>
          <small>Published {{lbFunctions::time_elapsed_string($post->post_timestamp)}}</small>
        </div>
      </div>
    </li>
    @endforeach

  </ul>
</div>
