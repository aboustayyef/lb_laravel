<script>

  // Initialize Lebanese Blogs App object
  
  if ( typeof lbApp != 'object'){
    lbApp = {}
  };

  // Set up app Variables that require php and blade logic
  lbApp.state = {
      imagePlaceHolder : '{{asset('/img/transparent.png')}}',
      rootPath : '{{URL::to('/')}}',
      pageKind : '{{$channel}}',
      currentPage : '{{Request::path()}}',
      currentPageNumber: 1,
      reachedEndOfPosts : false,
  };
    
</script>