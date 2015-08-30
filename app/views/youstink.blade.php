<ul>
@foreach ($posts as $post)

  <li>

    <h3><a href="{{$post->post_url}}">{{$post->post_title}}</a></h3>
    <h4>{{$post->blog->blog_name}}</h4>

  </li>

@endforeach
</ul>
