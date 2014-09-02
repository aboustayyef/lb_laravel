<?php
  /**
  *
  */
  class PostsController extends BaseController
  {

    /*
    *   This function displays our initial rendering of posts
    */

    function show($channel){

      // 1- $channel is a child resolve it to its parent channel;
      $canonicalChannel = Channel::resolveTag($channel);

      // 2- if we have a subchannel, redirect to main channel
      if ($canonicalChannel != $channel) {
        return Redirect::to('posts/'.$canonicalChannel);
      }
      $channelDescription = Channel::description($canonicalChannel);

      // set session for channel. Necessary for ajax calls;
      Session::put('channel', $canonicalChannel);
      Session::put('pageKind', 'general');

      $pageTitle = ($canonicalChannel == 'all') ? "Lebanese Blogs | Latest posts from the best Blogs" : "Lebanese Blogs | $channelDescription ";
      $pageDescription = ($canonicalChannel == 'all') ? "The best place to discover, read and organize Lebanon's top blogs" : "Lebanon's top blogs about $channelDescription";

      $posts = Post::getPosts($channel);
      //$posts = Post::getLatest($canonicalChannel);
      return View::make('posts.main')->with(array(
        'pageTitle'=>$pageTitle,
        'pageDescription'=> $pageDescription,
        'posts'=>$posts ,
        'from'=>0,
        'to'=>20));
    }

    public function favorites()
    {
      $userID = User::signedIn();
      Session::put('pageKind', 'favorites');
      $pageTitle = "Posts by My Favorite Bloggers";
      $pageDescription ="";
      $posts = Post::getFavoritePosts($userID);
      if ($posts) {
        return View::make('posts.main')->with(array(
          'pageTitle'=>$pageTitle,
          'pageDescription'=> $pageDescription,
          'posts'=>$posts ,
          'from'=>0,
          'to'=>20,
          'windowDetails' => array(
            'left-message'    =>    ['Favorites','15'], // second figure is width percentage
            'right-message'   =>    ['Posts by your favorite bloggers', '85' ],
            'color'           =>    '#ffcc66'
          ),
        ));
      } else {
        return View::make('posts.noFavoritesYet')->with(array(
          'pageTitle'=>'No Favorites Yet',
          'pageDescription'=> ''));
      }

    }

    public function saved(){
      $userID = User::signedIn();
      Session::put('pageKind', 'saved');
      $pageTitle = "Reading List";
      $pageDescription ="";
      $posts = Post::getSavedPosts($userID);
      if ($posts) {
        return View::make('posts.main')->with(array(
          'pageTitle'=>$pageTitle,
          'pageDescription'=> $pageDescription,
          'posts'=>$posts ,
          'from'=>0,
          'to'=>20,
          'windowDetails' => array(
            'left-message'    =>    ['Reading List','15'], // second figure is width percentage
            'right-message'   =>    ['Posts you marked for reading later', '85' ],
            'color'           =>    '#ffcc66'
          ),
        ));
      } else {
        return View::make('posts.noSavedYet')->with(array(
          'pageTitle'=>'No Saved Posts Yet',
          'pageDescription'=> ''));
      }
    }

    public function search(){
      $query = Input::get('q');
      if (empty($query)) {
        // if no parameters, forward back to home page
        return Redirect::to('/posts/all');
      }

      // prepare elastic search client

      $client = new Elasticsearch\Client();
      $searchParameters = array();
      $searchParameters['index']='lebaneseblogs';
      $searchParameters['type']='post';
      $searchParameters['size']  = 60; // to return all results
      $searchParameters['body']['query']['multi_match']['content'] = array(
        'query' => $query,
        'fuzziness' =>  0.8,
        'fields'  =>  ['title', 'content'],
      );

      $results = $client->search($searchParameters);

      $totalResults = $results['hits']['total'];
      $listOfIds = array();
      $posts = array();
      foreach ($results['hits']['hits'] as $key => $result) {
        $id = $result['_id'];
        $listOfIds[] = $id;
        $posts[] = Post::find($id);
        //echo 'score: ' . $result['_score'] . ' | ' . $result['_source']['title'] , '<br>';
      }
      //echo '<pre>',print_r($listOfIds),'</pre>';
      //echo '<pre>',print_r($results),'</pre>';
      if ($posts) {
        Session::put('pageKind', 'search');
        return View::make('posts.main')->with(array(
          'pageTitle'=> 'Search Results for ' . $query,
          'pageDescription'=> '',
          'posts'=>$posts ,
          'from'=>0,
          'to'=>20,
          'windowDetails' => array(
            'left-message'    =>    ['Search Result: ','25'], // second figure is width percentage
            'right-message'   =>    ['The term "'.$query.'" has: ' . $totalResults . ' results', '75' ],
            'color'           =>    '#999'
          ),
       ));
      } else {
        return View::make('posts.noSearchResults')->with(array(
          'pageTitle'=>'No results for ' . $query,
          'pageDescription'=> ''));
      }
    }
}
