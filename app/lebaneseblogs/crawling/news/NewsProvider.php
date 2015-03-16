<?php namespace LebaneseBlogs\Crawling\News ;


use Symfony\Component\DomCrawler\Crawler;


  /**
   * Creates a NewsProvider Object with methods to extract NewsItem Objects and NewsList Collections
   *
   * @param $provider
   */

  class NewsProvider
  {

    public $provider;
    private $articles = array();

    function __construct($news_provider_id = 'naharnet') // default to Naharnet
    {

      // Get list of all providers

      $NewsProviders = (new NewsProvidersDictionary)->all();

      // Loop through them to find the one with required id

      foreach ($NewsProviders as $key => $news_provider) {
        if ($news_provider['id'] == $news_provider_id) {
          $this->provider = $news_provider;
          return true;
        }
      }
        return false;
    }

    /**
     * Get the list of latest articles by the provider
     */

    public function getLatestArticles(){


    $scrapingInfo = $this->provider['scraping'];



    // Crawl Homepage
    // to do: Error Handling
    $crawler = new Crawler;
    $content = file_get_contents($this->provider['url']);
    $crawler->addHTMLContent($content, 'UTF-8');
    echo 'created General crawler'. "\n";

    // Gets collection of news items
    $containerCrawler = $crawler->filter($scrapingInfo['container']);
    echo 'Created List of containers, found '.$containerCrawler->count().'. will loop through them' . "\n";

    $count = 1;

    $maximum = 10;

    foreach ($containerCrawler as $containerKey => $containerNode) {
        try {
          echo "=== container $count: \n";
          // Get the link and title
          $linkCrawler = new Crawler($containerNode);

          echo 'created Headline/Link Crawler'."\n";

          $a = $linkCrawler->filter('a')->eq($scrapingInfo['orderOfAnchor']);
          $text = $a->text();
          $link = $a->attr('href');
          $link = $this->provider['root'].$link;

          // Check if there's a canonical Link in the body of the article to properly measure virality
          if (isset($scrapingInfo['canonical'])) {
            $canonicalCrawler = new Crawler;
            $articleContent = file_get_contents(Helpers::fixLink($link));
            $canonicalCrawler->addHTMLContent($articleContent, 'UTF-8');
            $canonical = $canonicalCrawler->filter($scrapingInfo['canonical']);
            $canonical = $canonical->attr($scrapingInfo['canonicalAttribute']);
            // Replace link with canonical link
            $link = $this->provider['root'].$canonical;
            }

          echo "Link is: $link \n";

          $virality = (new \SocialScore($link))->getVirality();

          // Get the image if it exists
          if (!empty($scrapingInfo['ImageContainer'])) {
            $imgCrawler = new Crawler($containerNode);
            echo 'added image crawler'."\n";
            if ($scrapingInfo['ImageContainer']=='[IMG]') {
              $img = $imgCrawler->filter('img')->first();
            }else {
              $img = $imgCrawler->filter($scrapingInfo['ImageContainer'].' img')->first();
            }

            $img = $scrapingInfo['ImageRoot'].$img->attr('src');

            if (!empty($img)) {
              // cache image
              $filename = md5($img).'.jpg';
              $directory = $_ENV['DIRECTORYTOPUBLICFOLDER'] . '/img/cache/'.$this->provider['id'] ;
              if (!file_exists($directory)) {
                mkdir($directory);
              }
              $image = new \imagick($img);
              $image->setFormat('JPEG');
              $image->cropThumbnailImage(70,70);
              $outFile = $directory. '/'. $filename;
              $image->writeImage($outFile);
            }
          }

          // Get the DateStamp
          if (!empty($scrapingInfo['timeContainer'])) {
            $timeCrawler = new Crawler($containerNode);
            echo 'added time crawler'."\n";
            $time = $timeCrawler->filter($scrapingInfo['timeContainer'])->first();
            $time = $time->text();
            $carbon= new \Carbon\Carbon($time, $scrapingInfo['timeZone']);

            $gmtDateTime = $carbon->setTimezone('GMT')->toDateTimeString();
          }

          if (empty($img)) {
            $img='';
          }

          $this->articles['content'][] = array(
            'headline'=>$text,
            'url'=> $link,
            'virality'=>$virality,
            'img'=>$img,
            'gmtDateTime'=>$gmtDateTime
            );

          $this->articles['meta'] = array(
            'feedTitle' => $this->provider['title'],
            'attribution'=> $this->provider['attribution'],
            'language'=>$this->provider['language']
          );
          $count++;
          if ($count > $maximum) {
            break;
          }
        } catch (Exception $e) {
          echo 'Sorry, problem with item '. "\n";
        }
      }
  }

    public function storeArticles(){
        \Cache::forever($this->provider['id'], $this->articles);
    }

  }

?>
