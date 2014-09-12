<?php
  /**
  *
  */
  class PostsController extends BaseController
  {

    /*
    *   This function displays our initial rendering of posts
    */

    function index($channel='all', $action=null){

      // 1- $channel is a child resolve it to its parent channel;
      $canonicalChannel = Channel::resolveTag($channel);

      // 2- if we have a subchannel, redirect to main channel
      if ($canonicalChannel != $channel) {
        return Redirect::to('posts/'.$canonicalChannel);
      }

      // set pageKind & channel sessions

      Session::put('channel', $canonicalChannel);
      if ($canonicalChannel == 'all') {
        Session::put('pageKind', 'allPosts');
      } else {
        Session::put('pageKind', 'channel');
      }

      // initialize posts counters
      Session::put('postsCounter', 0);
      Session::put('cardsCounter', 0);

      return View::make('posts.main');
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
