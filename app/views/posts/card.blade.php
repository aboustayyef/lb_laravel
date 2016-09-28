  <div class="card postID-{{$post->post_id}} post-{{Session::get('postsCounter')}} card-{{Session::get('cardsCounter')}}" >

  <!--==============================-->
  <!--    Post Image                -->
  <!--==============================-->

    @if ($post->image()->exists)
      <a class="exitLink" href="{{$post->exitLink()}}" rel="nofollow" onclick="ga('send', 'event', 'Exit Link', 'Card Posts' , '{{$blog->blog_name}}')">
        <div data-bg="{{ $post->image()->src }}" class="lazy" style="background-color:{{$post->image()->background_color}}; background-size:100%; ;padding-top:55%;     background-repeat: no-repeat; border-bottom:1px solid #ececec">
          </div>
      </a>
    @endif
    
    <!--==============================-->
    <!--    Post Body                 -->
    <!--==============================-->

    <div class="post_body"> 

      <!-- Meta Info (date & virality) -->

      <div class="metaInfo">
        <div class="postedSince">
          {{$post->carbonDate()->diffForHumans()}}
        </div>
        {{View::make('posts.partials.virality')->with('score',$post->post_virality)}}
      </div>

      <!-- Post Title -->

      <h2 class="post__title @if(!$post->image()->exists) headline_no_image  @endif">
        <a class="exitLink" href="{{$post->exitLink()}}" rel="nofollow" onclick="ga('send', 'event', 'Exit Link', 'Card Posts' , '{{$blog->blog_name}}')">
          {{str_limit($post->post_title, 80)}} 
        </a>
      </h2>

      <!-- rating -->
      @if ($post->hasRating())
        {{View::make('posts.partials.rating')->with('n',$post->rating_numerator)->with('d',$post->rating_denominator)}}
      @endif

    </div>

    <!--==============================-->
    <!--    Post Footer               -->
    <!--==============================-->

    <div class="blog__info @if (Session::get('pageKind') == 'blogger') blogger_page @endif">
      <div class="ut__flexWrapper blog__meta">
    
        <!-- Thumbnail -->
        <!-- Hide if Blogger's page -->

        <a class="ut__Valign" href="{{url('/blogger/'.$post->blog_id)}}">
          <img
            style="background: #F3E7E8"
            class="lazy blog__thumbnail"
            @if (app('env') == 'staging')
              src="{{ asset('https://static.lebaneseblogs.com/img/transparent.png') }}"
              data-original="https://static1.lebaneseblogs.com/{{$post->blog->blog_thumb.'.jpg'}}"
            @else
              src="{{ asset('/img/transparent.png') }}"
              data-original="{{asset('/img/thumbs/'.$post->blog->blog_thumb.'.jpg')}}"
            @endif
            alt="{{$blog->blog_name }} thumbnail"
            width ="40px" height="40px">
        </a>

        <!-- Blog's Name -->

        <div class="blog__name">
          <a href="{{url('/blogger/'.$post->blog_id)}}">
            {{ $blog->blog_name }}
          </a>
        </div>

      </div>

      <!-- Tweet Button -->
      <div class="tweetit ut__Valign">
        <!-- Card {{Session::get('cardsCounter')}} Post {{Session::get('postsCounter')}} -->
        <a href="{{$post->tweetLink()}}" title="Click to send this post to Twitter!" target="_blank" onclick="ga('send', 'event', 'Exit Link', 'Card Posts' , '{{$blog->blog_name}}')">
        <?php fontAwesomeToSvg::convert('fa-twitter') ?><span class="ut__HideMobile" Tweet</span>
        </a>
      </div>

    </div> <!-- /Blog Header -->
  </div> <!-- /card -->
