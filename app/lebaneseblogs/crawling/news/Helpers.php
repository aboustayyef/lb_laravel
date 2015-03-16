<?php namespace LebaneseBlogs\Crawling\News ;

  class Helpers
  {

    /**
     * Better url_encode for links with arabic characters
     *
     * @param   string $link , the url to be fixed
     * @return  string $fixedLink,the fixed url
     */

    static function fixLink($link){

      $url_parts = parse_url($link);
      $part_to_encode = $url_parts['path'];
      $encoded = urlencode($part_to_encode);
      $encoded = preg_replace('#\%2F#','/', $encoded);
      $encoded = preg_replace('#\_#', '%84', $encoded);
      $fixedLink = $url_parts['scheme'] . '://' . $url_parts['host'] . $encoded;
      return $fixedLink;

    }

  }

?>
