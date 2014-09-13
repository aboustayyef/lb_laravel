<div class="post_wrapper">
  <div class="card no_min"><?php $term = Input::get('q') ?>
    <h2>Search Results for "{{$term}}"</h2>
    <p>We found <?php echo count(Session::get('searchResults')) ?>results for the term {{$term}}</p>
    <p>The most relevant results are at the top</p></div>
</div>
