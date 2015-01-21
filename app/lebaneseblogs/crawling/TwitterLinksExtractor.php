<?php namespace LebaneseBlogs\Crawling;

use Symfony\Component\DomCrawler\Crawler ;

/**
*
*/
class TwitterLinksExtractor
{
  private $html, $crawler, $user;

  function __construct($twitterUser)
  {
    $this->user = $twitterUser;
    $this->html = @file_get_contents('https://twitter.com/'.$twitterUser);
    $this->crawler = new Crawler($this->html);
  }

  public function listOfLinks(){
    $list = [];
    $links = [];
    $raw = $this->tweets();
    foreach ($raw as $key => $tweet) {
      foreach ($tweet['links'] as $key2 => $link) {
        $links[] = $link;
      }
    }

      $list['user'] = $this->user;
      $list['links'] = $links;
      var_dump($list);
  }

  function tweets(){
    $TweetsCrawler = $this->crawler->filter('.ProfileTweet');
    $tweets = [];

    foreach ($TweetsCrawler as $key => $tweet) {
      $detailsCrawler = new Crawler($tweet);

      $timestamp = $detailsCrawler->filter('.js-short-timestamp');
      $timestamp = $timestamp->attr('data-time');

      $links = $detailsCrawler->filter('a.twitter-timeline-link');
      $tweetlinks =[];
      foreach ($links as $key => $link) {
        $theLink = $link->getAttribute('title');
        if (empty($theLink)) {
          continue;
        } else {
          $linkToResolve = $link->getAttribute('title');
          $urlResolver = new UrlResolver($linkToResolve);
          $effeciveUrl = $urlResolver->resolve();
          $tweetlinks[] = $effeciveUrl;
        }
      }

      $hashtags = $detailsCrawler->filter('.twitter-hashtag.pretty-link b');
      $tweetHashtags = [];
      foreach ($hashtags as $key => $hashtag) {
        $theHashtag = $hashtag->nodeValue;
        if (empty($theHashtag)) {
          continue;
        } else {
          $tweetHashtags[] = $hashtag->nodeValue ;
        }
      }

        $tweets[] = array(
          'timestamp' => $timestamp,
          'links' =>$tweetlinks,
          'hashtags' => $tweetHashtags
        );
    }
    return $tweets;
  }
}

 ?>
