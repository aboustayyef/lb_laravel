<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Lebanese Blogs</title>
  <link rel="stylesheet" href="{{asset('css/static.css')}}">
</head>


<body>

<div id="pageWrapper">
  <header>
    <div class="inner">
    <a href="{{URL::to('/posts/all')}}"><div id="logo">
        Lebanese Blogs;
      </div></a>
    </div>
  </header>
  <div id="contentWrapper" class="inner">
      <aside>
        <ul>
          <a href="{{URL::to('/about')}}"
          <?php if (empty($slug)) {
            echo 'class="active" ';} ?>>
            <li>About</li>
          </a>
          <a href="{{URL::to('/about/faq')}}"
          <?php if ($slug == 'faq') {
            echo 'class="active" ';} ?>>
            <li>Frequently Asked Question</li>
          </a>
          <a href="{{URL::to('/about/submit')}}"
          <?php if ($slug == 'submit') {
            echo 'class="active" ';} ?>>
            <li>Submit Your Blog</li>
          </a>
          <a href="{{URL::to('/about/feedback')}}"
          <?php if ($slug == 'feedback') {
            echo 'class="active" ';} ?>>
            <li>Submit Feedback</li>
          </a>
          <a href="{{URL::to('/about/badge')}}"
          <?php if ($slug == 'badge') {
            echo 'class="active" ';} ?>>
            <li>Add our Badge to your blog</li>
          </a>
        </ul>
      </aside>

      <div class="content">
        @yield('content')
      </div>
    </div>
  <footer>
    <div class="inner">
      <?php echo 'Lebanese Blogs ' . date('Y') . ' &copy;'; ?>
    </div>
  </footer>
</div> <!-- /pageWrapper -->

</body>
</html>
