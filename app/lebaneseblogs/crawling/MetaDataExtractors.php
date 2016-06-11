<?php namespace LebaneseBlogs\Crawling;

use Symfony\Component\DomCrawler\Crawler ;

  /**
  *
  */
  class MetaDataExtractor
  {
    private $html, $crawler;
    public $success = false;

    function __construct($url)
    {
      $this->html = @file_get_contents($url);
      if (!$this->html) {
        return false;
      }
      $this->success = true;
      $this->crawler = new Crawler($this->html);
    }

    function title(){
      $title = $this->crawler->filter('title')->first()->text();

      // some titles come with description, split them;
      $partsOfTitle = preg_split('#\s*\||–\s*#',$title);

      return trim($partsOfTitle[0]);
    }

    function feed(){
      $crawler = new Crawler($this->html);
      try {
        $feed = $this->crawler->filter('link[type="application/rss+xml"]')->first()->attr('href');
      } catch(\InvalidArgumentException $e){
          return false;
      }
      return $feed;
    }

    function engine(){

    }

  }

?>
