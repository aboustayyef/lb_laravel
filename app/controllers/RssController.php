<?php
/**
* TESTING SIMPLEPIE
*/
class RssController extends BaseController
{
  
  public function getPosts(){
    $feed = new SimplePie();
    $feed->set_feed_url('http://mustapha.me/feed');
    $feed->init();
    foreach($feed->get_items(0,10) as $key=>$item){
      echo $item->get_title().'<br>';
    }
  }
}

?>