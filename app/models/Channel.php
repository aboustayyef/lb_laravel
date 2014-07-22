<?php 

/*
|----------------------------------------------------------------------
| This model handles channels and tags. 
| It doesn't use a databases because the data is very minimal
|----------------------------------------------------------------------
|
*/

class Channel
{
  private static $tagrouter =  array(
    'all'         => 'all',
    'fashion'     => 'fashion',
    'style'       => 'fashion', 
    'food'        => 'food',
    'health'      => 'food',
    'family'      => 'society',
    'society'     => 'society',
    'politics'    => 'politics',
    'tech'        => 'tech',
    'business'    => 'tech',
    'media'       => 'media',
    'music'       => 'media',
    'tv'          => 'media',
    'film'        => 'media',
    'advertising' => 'design',
    'design'      => 'design',
    'photography' => 'design',
    'art'         => 'design',
    'columnists'  => 'columnists',
    );

  public static $list =  array(
    array(
      'name'        =>  'columnists',
      'description' =>  'Columnists',
      'icon'        =>  'fa-quote-right',
      'color'       =>  '#001F3F' // navy
    ),
    array(
      'name'        =>  'fashion',
      'description' =>  'Fashion & Style',
      'icon'        =>  'fa-umbrella',
      'color'       =>  '#C50161'
    ),
    array(
      'name'        =>  'food',
      'description' =>  'Food & Health',
      'icon'        =>  'fa-coffee',
      'color'       =>  '#FF851B'
    ),
    array(
      'name'        =>  'society',
      'description' =>  'Society & Fun News',
      'icon'        =>  'fa-smile-o',
      'color'       =>  '#3D9970'
    ),
    array(
      'name'        =>  'politics',
      'description' =>  'Politics & Current Affairs',
      'icon'        =>  'fa-globe',
      'color'       =>  '#A76336'
    ),
    array(
      'name'        =>  'tech',
      'description' =>  'Tech & Business',
      'icon'        =>  'fa-laptop',
      'color'       =>  '#6C88A0'
    ),
    array(
      'name'        =>  'media',
      'description' =>  'Music, TV & Film',
      'icon'        =>  'fa-music',
      'color'       =>  '#02A7A7'
    ),
    array(
      'name'        =>  'design',
      'description' =>  'Advertising & Design',
      'icon'        =>  'fa-picture-o',
      'color'       =>  '#111111'
    )
  );

  public static function resolveTag($tag){
    if (array_key_exists($tag, self::$tagrouter)){
      // only change the channel if explicitely asked
      return self::$tagrouter[$tag];
    } else {
      return 'all';
    }
  }

  public static function description($canonical){
    foreach (self::$list as $key => $channel) {
      if ($channel['name'] == $canonical) {
        return $channel['description'];
      }
    }
  }

  public static function icon($canonical){
    foreach (self::$list as $key => $channel) {
      if ($channel['name'] == $canonical) {
        return $channel['icon'];
      }
    }
    return "fa-question";
  }

  public static function color($canonical){
    foreach (self::$list as $key => $channel) {
      if ($channel['name'] == $canonical) {
        return $channel['color'];
      }
    }
    return "fa-question";
  }

}