<?php namespace LebaneseBlogs\Crawling;

use Symfony\Component\DomCrawler\Crawler ;

/**
*
*/
class TwitterLinksExtractor
{
  private $html, $crawler;

  function __construct($twitterUser)
  {
    $this->html = @file_get_contents('https://twitter.com/'.$twitterUser);
    $this->crawler = new Crawler($this->html);
  }

  function links(){
    $TweetsCrawler = $this->crawler->filter('.ProfileTweet');
    $tweets = [];
    foreach ($TweetsCrawler as $key => $tweet) {
      $detailsCrawler = new Crawler($tweet);

      $timestamp = $detailsCrawler->filter('.js-short-timestamp');
      $timestamp = $timestamp->attr('data-time');

      $links = $detailsCrawler->filter('a.twitter-timeline-link');
      $tweetlink ='';
      foreach ($links as $key => $link) {
        if (empty($link->getAttribute('title'))) {
          continue;
        } else {
          $tweetlinks = $link->getAttribute('title');
          break;
        }
      }
      if (!empty($tweetlinks)) {
        $tweets[] = array(
          'timestamp' => $timestamp,
          'link' =>$tweetlinks
        );
      }
    }
    var_dump($tweets);
  }
}

 ?>
