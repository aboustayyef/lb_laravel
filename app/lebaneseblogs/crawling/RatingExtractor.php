<?php namespace LebaneseBlogs\Crawling;

use Symfony\Component\DomCrawler\Crawler ;

class RatingExtractor{

  public $numerator;
  public $denominator;

  private $content;

  public function __construct($html){
    $this->content = $html;
  }

  public function getRating(){
      preg_match('#(r|R)ating\s*:\s*(\d+(\.5)?)/(\d+)#', $this->content, $result);
      if (is_array($result) && (count($result) >= 4) ) {
        $this->numerator = $result[2];
        $this->denominator = $result[4];
        return true;
      } else {
        return false;
      }
  }

  public function getNgnoRating(){
    $crawler = new Crawler($this->content);
    $ratingCrawler = $crawler->filter('.rating-result');
    if ($ratingCrawler->count() == 0) {
      return false;
    } else {
      $onOnions = $ratingCrawler->filter('img[src="/img/onion_on.png"]')->count();
      $this->numerator = $onOnions;
      $this->denominator = 10;
      return true;
    }
  }

}


?>
