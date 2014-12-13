<?php

/**
*
*/
class NewsScrapingDictionary {

  protected $sources;

  public function __construct(){

    $this->sources = array(

      // LBC
      array(
      'id'=>'lbci', // this will be used as a unique identifier
      'url'=>'http://www.lbcgroup.tv/news/category/1/%D8%A3%D8%AE%D8%A8%D8%A7%D8%B1-%D9%85%D8%AD%D9%84%D9%8A%D8%A9', // url where list of articles is
      'title'=>'آخر اخبار لبنان', // the title of the news section
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
      ),

      // NAHARNET
      array(
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
      ),

      // NNA English
      array(
      'id'=>'nna_english',
      'url'=>'http://www.nna-leb.gov.lb/en/latest-news/',
      'title'=>'Latest Lebanon News',
      'attribution'=> 'Source: National News Agency',
      'root'=>'',
      'language'=> 'English',
      'scraping'=>array(
        'container'=>'.latest-news-list-div li',
        'orderOfAnchor' => 0 ,
        'ImageContainer' => '',
        'ImageRoot' =>  '', // If images are relative
        'timeContainer'=>'.time',
        'timeZone'  =>  'Asia/Beirut'
        )
      ),

    );
  }

  public function sources(){
    return $this->sources;
  }

  public function source($sourceID){
    foreach ($this->sources as $key => $source) {
      if ($source['id'] == $sourceID) {
        return $source;
      }
    }
    return false;
  }

}

?>
