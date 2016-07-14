  <div class="card postID-{{$post->post_id}} post-{{Session::get('postsCounter')}} card-{{Session::get('cardsCounter')}}" >

  <!-- Post image (if any ) -->
    @if ($post->post_image_height > 0)
      <a class="exitLink" href="{{URL::to('/exit').'?url='.urlencode($post->post_url).'&token='.Session::get('_token')}}" onclick="ga('send', 'event', 'Exit Link', 'Card Posts' , '{{$blog->blog_name}}')">
        <div class="imageWrapper"><img
            class="lazy cardImage"
            data-original="{{ $post->image()->src }}"
            src="{{ asset('/img/transparent.png') }}"
            width="300px"
            height="{{ 300 * $post->image()->ratio }}"
            style="background-color:{{$post->image()->background_color}}"
          ></div>
      </a>
    @endif

    <!-- Post Body -->
    <script>
      var data{{$post->post_id}} = {{$post->toJson()}};
      var exiturl{{$post->post_id}} = "{{URL::to('/exit').'?url='.urlencode($post->post_url).'&token='.Session::get('_token')}}";
    </script>
    <div class="post_body"> {{-- onclick="lbApp.showPost(data{{$post->post_id}}, exiturl{{$post->post_id}})"  --}}
      <div class="metaInfo">
        <div class="postedSince">
          {{lbFunctions::time_elapsed_string($post->post_timestamp)}}
        </div>
        {{View::make('posts.partials.virality')->with('score',$post->post_virality)}}
      </div>

      <!-- Post Title -->
      <h2 class="post__title @if(!$post->post_image_height > 0) headline_no_image  @endif">
        <!-- outward url -->
        <a class="exitLink" href="{{URL::to('/exit').'?url='.urlencode($post->post_url).'&token='.Session::get('_token')}}" onclick="ga('send', 'event', 'Exit Link', 'Card Posts' , '{{$blog->blog_name}}')">{{str_limit($post->post_title, 80)}} </a>

        <!-- rating -->
        <?php

          if (($post->rating_denominator > 0) && ($post->rating_numerator > 1)) {
            echo '<!-- Rating -->';
            echo View::make('posts.partials.rating')->with('n',$post->rating_numerator)->with('d',$post->rating_denominator);
          }
        ?>
      </h2>
    </div>

    <!-- Blog Header . don't show where we're at the blog's page -->
    <div class="blog__info @if (Session::get('pageKind') == 'blogger') blogger_page @endif">
      <div class="ut__flexWrapper blog__meta">
        <!-- Thumbnail -->
        <a class="ut__Valign" href="{{url('/blogger/'.$post->blog_id)}}">
          <img
            style="background: #F3E7E8"
            class="lazy blog__thumbnail"
            @if (app('env') == 'staging')
              src="{{ asset('http://static.lebaneseblogs.com/img/transparent.png') }}"
              data-original="http://static1.lebaneseblogs.com/{{$post->blog_id.'.jpg'}}"
            @else
              src="{{ asset('/img/transparent.png') }}"
              data-original="{{asset('/img/thumbs/'.$post->blog_id.'.jpg')}}"
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
      <div class="tweetit ut__Valign">
        <?php
          "%title% %url% [by %@author%] via lebaneseblogs.com";
          $byline = $blog->blog_author_twitter_username ? " by @$blog->blog_author_twitter_username" : "";
          $byline .= " via lebaneseblogs.com";
          $allowedTitleSize = 140 - strlen($byline) - 28; // urls count for 22 chars on twitter and we add space
          $byline = ' ' . $post->post_url . $byline;
          $postTitle = $post->post_title;
          if (strlen($postTitle) >= $allowedTitleSize) {
            $postTitle = substr($postTitle, 0, ($allowedTitleSize - 4)) . '... ';
          }
          $tweetExpression = $postTitle.$byline;
          $twitterUrl = urlencode($tweetExpression);
        ?>
        <a href="https://twitter.com/intent/tweet?text={{$twitterUrl}}" title="Click to send this post to Twitter!" target="_blank" onclick="ga('send', 'event', 'Exit Link', 'Card Posts' , '{{$blog->blog_name}}')">
          <?php fontAwesomeToSvg::convert('fa-twitter') ?> Tweet
        </a>

      </div>
    </div> <!-- /Blog Header -->


  </div> <!-- /card -->
