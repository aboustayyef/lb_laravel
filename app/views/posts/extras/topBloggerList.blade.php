<?php
$blog = Session::get('blogger');
$blogOrColumn = Blog::where('blog_id',$blog)->count();
if ($blogOrColumn > 0) { // blog
  $blogName = Blog::where('blog_id',$blog)->first()->blog_name;
} else {
  $blogName = Columnist::where('col_shorthand', $blog)->first()->col_name;
}

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
          {{View::make('images.topListThumb')->with('post',$post)}}
        </div>
        <div class="details">
          <a href="{{$post->post_url}}"><h3>{{$post->post_title}}</h3></a>
          <span>Published {{lbFunctions::time_elapsed_string($post->post_timestamp)}}</span>
        </div>
      </div>
    </li>
    @endforeach

  </ul>
</div>
