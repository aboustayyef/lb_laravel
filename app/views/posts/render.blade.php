{{-- 
This will render the html of the actual posts, 
it can be used for ajax as well as normal display
--}}
    
    
    {{-- handles injection of extra cards --}}
    <?php $counter = $from + 1 ?>
    
    
    @foreach ($posts as $post)

    {{ View::make('posts.extras.main')->with('counter', $counter) }}
    
      <div class="post_wrapper">
        
        <!-- Blog Header -->
        <div class="blog_header">

          <!-- Thumbnail -->
          <img 
          class="thumbnail" 
          src="{{asset('/img/thumbs/'.$post->blog_id.'.jpg')}}" 
          alt="{{$post->blog_name }} thumbnail" 
          width ="50px" height="50px">
          
          <!-- Blog's Name -->
          <div class="blogname">
            <a href="{{url('/blogger/'.$post->blog_id)}}">
              {{ $post->blog_name }}
            </a>
          </div>

          <div class="fave">
            <i class ="fa fa-star-o"></i>
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
            <a href="{{URL::to('/r').'?url='.urlencode($post->post_url)}}">{{ $post->post_title }} </a>
            
            {{ $counter }}
          </h2>

          <!-- Post image (if any ) -->
            @if ($post->post_image_height > 0)
              <a href="{{URL::to('/r').'?url='.urlencode($post->post_url)}}">
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
        <div class="shareButton">
            <i class="fa fa-share"></i> Share
        </div>      
        <ul class="sharing">
          <a href="">
            <li>
              <div class ="shareIcon">
                <i class="fa fa-clock-o"></i>
              </div>
              <div class ="shareDescription">
                Read Later
              </div>
            </li>
          </a>
          <a href="">
            <li class ="middle">
              <div class ="shareIcon">
                <i class="fa fa-twitter"></i>
              </div>
              <div class ="shareDescription">
                Twitter
              </div>
            </li>
          </a>
          <a href="">
            <li>
              <div class ="shareIcon">
                <i class="fa fa-facebook"></i>
              </div>
              <div class ="shareDescription">
                Facebook
              </div>
            </li>
          </a>
        </ul>

      </div> <!-- /post wrapper -->
      <?php $counter++ ?>
  @endforeach
