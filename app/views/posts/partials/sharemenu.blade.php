<div class="bubblewrapper">
  <ul class="sharing">
    <li class="header">This Blog</li>
    <li><a href ="/blogger/{{$post->blog_id}}"><i class="fa fa-info-circle"></i>Learn more about this blog</a></li>

    @if(User::signedIn())
      @if($ourUser->hasFavoriteBlog($post->blog_id))
      <li class="removeFromFavorites" data-userId="{{$ourUser->id}}" data-blogId="{{$post->blog_id}}"><i class="fa fa-star"></i>Remove it from your favorites</li>
      @else
      <li class="addToFavorites" data-userId="{{$ourUser->id}}" data-blogId="{{$post->blog_id}}"><i class="fa fa-star"></i>Add it to your favorites</li>
      @endif
    @else
      <li class ="dim"><i class="fa fa-star"></i>Add it to your favorites</li>
    @endif

    <li class="header">This Post</li>
    <li><i class="fa fa-facebook"></i>Share On Facebook</li>
    <li><i class="fa fa-twitter"></i>Share On Twitter</li>
    <li><i class="fa fa-clock-o"></i>Save for later</li>
  </ul>
</div>
