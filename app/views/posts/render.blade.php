{{--
This will render the html of the actual posts,
it can be used for ajax as well as normal display
--}}


    <?php
      $counter = isset($from)? $from + 1 : 1;
      $ourUser = User::find(Session::get('lb_user_id'));
    ?>


    @foreach ($posts as $post)

    {{-- handles injection of extra cards --}}
    {{ View::make('posts.extras.main')->with('counter', $counter) }}

    <?php
      $blog = Blog::where('blog_id',$post->blog_id)->remember(15)->first();
    ?>
      <div class="post_wrapper"> <!-- /For grouping items together -->

        <div class="card">
        <!-- Blog Header -->
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
        </div>

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
        </div>
        <div class="sharingButton tweetit">
          <i class="fa fa-twitter"></i>
          Tweet it
        </div>
        <div class="sharingButton action">
            <i class="fa fa-share"></i> More
        </div>
        {{View::make('posts.partials.sharemenu')->with(['post'=>$post,'ourUser'=>$ourUser])}}
        </div>
      </div> <!-- /post wrapper -->
      <?php $counter++ ?>
  @endforeach
