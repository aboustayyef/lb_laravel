@include('partials.header')
@include('partials.sidebar')
@include('partials.topbar')

<div id="content">
    <div class="posts cards"> <!-- cards is default -->
    	<div class="blogger">
	      @include('posts.render', array('posts', $posts))
	    </div>
    </div>
</div>
      
@include('partials.footer')