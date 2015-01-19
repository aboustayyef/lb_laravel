<?php namespace LebaneseBlogs\Crawling;

use Symfony\Component\DomCrawler\Crawler ;

  interface ImageExtractor{
    function getImage();
  }


  /**
  *
  */
  class TwitterImageExtractor implements ImageExtractor
  {
    private $html;

    function __construct($twitterHandle)
    {
      $this->html = @file_get_contents('http://twitter.com/'.$twitterHandle);
      if (!$this->html) {
        return false;
      }
    }

    function getImage(){
      $crawler = new Crawler($this->html);
      $image = $crawler->filter('img.ProfileAvatar-image')->first()->attr('src');
      return $image;
    }

  }

?>
