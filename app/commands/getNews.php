<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\DomCrawler\Crawler;

class getNews extends Command {

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'lebaneseBlogs:getNews';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'get News';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */

  public function fire(){
    $this->getLBC();
    $this->getNaharnet();
  }
public function getLBC()
  {
    // get naharnet
    $lbcDefinitions = array(
      'id'=>'lbci', // this will be used as a unique identifier
      'url'=>'http://www.lbcgroup.tv/news/category/1/%D8%A3%D8%AE%D8%A8%D8%A7%D8%B1-%D9%85%D8%AD%D9%84%D9%8A%D8%A9', // url where list of articles is
      'title'=>'اخر اخبار لبنان', // the title of the news section
      'attribution'=> 'المصدر: المؤسسة اللبنانية للارسال', // how the news is attributed
      'root'=>'http://www.lbcgroup.tv', // for relative urls, add base url
      'language'=> 'Arabic',
      'scraping'=>array(
        'container'=>'.MyinsideDivOfRepeater', // the wrapper around a news item
        'orderOfAnchor' => 1 , // 0 if the first 'a' link is the title
        'ImageContainer' => '[IMG]', // where Images are wrapped, [IMG] means no container, just the img tag
        'ImageRoot' =>  'http://www.lbcgroup.tv', // If images are relative
        'timeContainer'=>'.BgProgTime2', // date selector
        'timeZone'  =>  'Asia/Beirut', // for international timing
      )
    );
    $lbcNewsObject = new newsObject($lbcDefinitions);
    $scraper = new htmlNewsScraper($lbcNewsObject);
    $scraper->getLatestArticles();
    $scraper->storeArticles();
  }

  public function getNaharnet()
  {
    // get naharnet
    $naharnetDefinitions = array(
      'id'=>'naharnet',
      'url'=>'http://naharnet.com/lebanon',
      'title'=>'Latest Lebanon News',
      'attribution'=> 'Source: Naharnet',
      'root'=>'http://naharnet.com',
      'language'=> 'English',
      'scraping'=>array(
        'container'=>'.latest-story',
        'orderOfAnchor' => 0 ,
        'ImageContainer' => '.picture-wrap',
        'ImageRoot' =>  '', // If images are relative
        'timeContainer'=>'.timeago',
        'timeZone'  =>  'Asia/Beirut'
      )
    );
    $naharnetNewsObject = new newsObject($naharnetDefinitions);
    $scraper = new htmlNewsScraper($naharnetNewsObject);
    $scraper->getLatestArticles();
    $scraper->storeArticles();
  }

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return array(
      //array('hours', InputArgument::OPTIONAL, 'The number of hours to check for'),
    );
  }

  /**
   * Get the console command options.
   *
   * @return array
   */
  protected function getOptions()
  {
    return array(
      //array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
    );
  }

  public static function isListicle($title){
    $title = strtolower($title);
    $parts = explode(" ", $title);
    $firstWord = $parts[0];
    if (count($parts) > 1) {
      $secondWord = $parts[1];
    } else {
      $secondWord = 'NotANumber';
    }

    $listOfNumbers = array('3','4','5','6','7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', 'three','four','five','six','seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen');
    if ((in_array($firstWord, $listOfNumbers))||(in_array($secondWord, $listOfNumbers))) {
      return TRUE;
    }else{
      return FALSE;
    }
  }

}
