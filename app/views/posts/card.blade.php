<div class="post_wrapper post-{{Session::get('postsCounter')}} card-{{Session::get('cardsCounter')}}"> <!-- /For grouping items together -->

  <div class="card">

    <!-- Blog Header . don't show where we're at the blog's page -->
    @if (Session::get('pageKind') != 'blogger')
    <div class="blog_header">
      <!-- Thumbnail -->
      <a href="{{url('/blogger/'.$post->blog_id)}}">
        <img
          class="thumbnail"
          src="{{asset('/img/thumbs/'.$post->blog_id.'.jpg')}}"
          alt="{{$blog->blog_name }} thumbnail"
          width ="50px" height="50px">
      </a>
      <!-- Blog's Name -->
      <div class="blogname">
        <a href="{{url('/blogger/'.$post->blog_id)}}">
          {{ $blog->blog_name }}
        </a>
      </div>

      <!-- Follow button -->
      @if(User::signedIn())
        @if($ourUser->follows($post->blog_id))
          <div data-blogid="{{$post->blog_id}}" class="followBlogger followed"></div>
        @else
          <div data-blogid="{{$post->blog_id}}" class="followBlogger"></div>
        @endif
      @else
        <div data-blogid="{{$post->blog_id}}" class="login followBlogger"></div>
      @endif
    </div> <!-- /Blog Header -->
      @endif

    <!-- Post Body -->

    <div class="post_body">
      <div class="metaInfo">
        <div class="postedSince">
          {{lbFunctions::time_elapsed_string($post->post_timestamp)}}
        </div>
        {{View::make('posts.partials.virality')->with('score',$post->post_virality)}}
      </div>
      <!-- Post Title -->
      <h2
        @if (lbFunctions::isArabic($post->post_title))
         class="rtl"
        @endif
        >
        <!-- outward url -->
        <a href="{{URL::to('/exit').'?url='.urlencode($post->post_url)}}">{{ $post->post_title }} </a>
      </h2>

      <!-- Post image (if any ) -->
        @if ($post->post_image_height > 0)
          <a href="{{URL::to('/exit').'?url='.urlencode($post->post_url)}}">
            {{View::make('posts.partials.post_image')->with('post',$post)}}
          </a>
        @else
      <!-- Post Excerpt (If no image) -->
          <p class ="excerpt
          @if (lbFunctions::isArabic($post->post_excerpt))
           rtl">
          @else
            ">
          @endif
            {{$post->post_excerpt}}
          </p>
        @endif
    </div>

    <div class="tools_footer">
      &nbsp; {{-- This just creates a free space at the bottom of each post --}}
      <?php $blogOwner = $blog->blog_author_twitter_username ?>
    </div>
    @if (User::signedIn())
      @if ($ourUser->twitter_username == 'beirutspring' ||  $ourUser->twitter_username == $blogOwner)
        <div class="editpost">
          {{link_to('/edit/post/'.$post->post_id, 'edit this post', ['class'  =>  'button'])}}
        </div>
        @endif
    @endif
    <div class="sharingButton tweetit">
      <i class="fa fa-twitter"></i>
      Tweet
    </div>
    <div data-postid="{{$post->post_id}}" class="sharingButton likeit
    <?php if(User::signedIn()){
      if ($ourUser->likes($post->post_id)) {
        echo ' liked ';
      } else {
        echo ' unliked';
      }
    }?>">
        <i class="fa fa-heart"></i> like
    </div>
  </div> <!-- /card -->
</div> <!-- /post wrapper -->
