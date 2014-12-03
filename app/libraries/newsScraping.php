<?php
use Symfony\Component\DomCrawler\Crawler;

// Data Transfer object
// This object holds all the data relating to the news source (eg naharnet)
class newsObject
{
  public $nameid, $title, $locationDefinitions, $root;
  function __construct($url, $nameid, $title, $root,  array $locationDefinitions)
  {
    $this->url = $url;
    $this->nameid = $nameid;
    $this->title = $title;
    $this->root = $root;
    $this->locationDefinitions = $locationDefinitions;
  }
}

// bluePrint for the scraping class
abstract class newsScraper{
    protected $articles;
    public $newsObject;
    public function __construct(newsObject $newsObject){
        $this->newsObject = $newsObject;
    }

    // get the value of $this->articles
    abstract function getLatestArticles();

    function storeArticles(){
      Cache::forever($this->newsObject->nameid, $this->articles);
    }
}

// html scraping class, uses the newsObject;
class htmlNewsScraper extends newsScraper
{
  public function getLatestArticles(){
    $this->articles = array();
    $content = file_get_contents($this->newsObject->url);

    // initial crawler
    $crawler = new Crawler($content);

    foreach ($this->newsObject->locationDefinitions as $key => $definition) {
      // the container within which we expect to find the anchor elements
      $parentOfAnchor = $definition[0];

      // the order of the anchor element that has text
      //(sometimes, an img anchor element precedes the text)
      $orderOfAnchor = $definition[1];

      $crawler2 = $crawler->filter($parentOfAnchor);
      foreach ($crawler2 as $key => $domnode) {
        $crawler3 = new Crawler($domnode);
        $a = $crawler3->filter('a')->eq($orderOfAnchor);
        $text = $a->text();
        $link = $a->attr('href');
        $link = $this->newsObject->root.$link;
        $score = new SocialScore($link);
        $this->articles[] = array('headline'=>$text, 'url'=> $link, 'virality'=>$score->getVirality());
      }
    }
    var_dump($this->articles);
  }
}

?>
