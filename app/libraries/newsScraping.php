<?php
use Symfony\Component\DomCrawler\Crawler;
use Carbon\Carbon;

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

    $definition = $this->newsObject->locationDefinitions;

    // Entire Page Crawler
    $crawler = new Crawler($content);

    // Gets a list of containers that contain our news items
    $containerCrawler = $crawler->filter($definition['container']);

    foreach ($containerCrawler as $containerKey => $containerNode) {

        // Get the link and title
        $linkCrawler = new Crawler($containerNode);
        $a = $linkCrawler->filter('a')->eq($definition['orderOfAnchor']);
        $text = $a->text();
        $link = $a->attr('href');
        $link = $this->newsObject->root.$link;
        $virality = (new SocialScore($link))->getVirality();

        // Get the image if it exists
        if (!empty($definition['ImageContainer'])) {
          $imgCrawler = new Crawler($containerNode);
          $img = $imgCrawler->filter($definition['ImageContainer'].' img')->first();
          $img = $img->attr('src');

          // cache image
          $filename = md5($img).'.jpg';
          $image = new imagick($img);
          $image->setFormat('JPEG');
          $image->cropThumbnailImage(50,50);
          $outFile = $_ENV['DIRECTORYTOPUBLICFOLDER'] . '/img/cache/'.$this->newsObject->nameid.'/'.$filename;
          $image->writeImage($outFile);
        }

        // Get the DateStamp
        if (!empty($definition['timeContainer'])) {
          $timeCrawler = new Crawler($containerNode);
          $time = $timeCrawler->filter($definition['timeContainer'])->first();
          $time = $time->text();
          $carbon= new Carbon($time, $definition['timeZone']);

          $gmtDateTime = $carbon->setTimezone('GMT')->toDateTimeString();
        }

        $this->articles['content'][] = array(
          'headline'=>$text,
          'url'=> $link,
          'virality'=>$virality,
          'img'=>$img,
          'gmtDateTime'=>$gmtDateTime
          );
        $this->articles['meta'] = array(
          'feedTitle' => $this->newsObject->title
        );
      }
    var_dump($this->articles);
  }
}

?>
