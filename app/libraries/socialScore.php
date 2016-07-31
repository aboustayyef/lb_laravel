<?php

/**
* Social Score Class, based on: http://99webtools.com/script-to-get-shared-count.php
*/

class SocialScore extends BaseController
{
  protected $url;
  protected $timeout;

  protected $facebookScores;   // how many times url was shared, liked and commented on facebook;

  function __construct($url,$timeout=10)
  {
    if (empty($url)) {
      die('url should be set in SocialScore class');
    }
    $this->url = $url;
    $this->timeout = $timeout;
    $this->facebookScores = $this->get_fb();
  }

  public function getFacebookLikes()
  {
    if ($this->facebookScores) {
      return $this->facebookScores['like_count'];
    }
    return false;
  }

  public function getFacebookShares()
  {
    if ($this->facebookScores) {
      return $this->facebookScores['share_count'];
    }
    return false;
  }

  public function getFacebookComments()
  {
    if ($this->facebookScores) {
      return $this->facebookScores['comment_count'];
    }
    return false;
  }

  public function getVirality()
  {
    // get facebook likes and shares;
    $facebookLikes = $this->getFacebookLikes();
    $facebookShares = $this->getFacebookShares();
    $facebookComments = $this->getFacebookComments();

    // weight scores by coefficients. 
    $coef_comm = 1;
    $coef_like = 2; // likes are 2 times more important than comments;
    $coef_shares = 7; // shares most important indicator. 7 times as important as comments;

    $coef_tot = $coef_comm + $coef_like + $coef_shares; 
    
    $weightedValue = round(($coef_comm * $facebookComments + $coef_like * $facebookLikes + $coef_shares * $facebookShares) / $coef_tot);

    $totalShares = $weightedValue * 2;

    // calculate virality
    $virality = $totalShares > 1 ? round( 8 * log($totalShares) ) : 2 ;

    // set virality's upper limit of 50
    if ($virality > 50) {
      $virality = 50;
    }
    return $virality;
  }

  // Helper functions (the meat)

  private function get_fb()
  {
    try {
      $json_string = $this->file_get_contents_curl('http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls='.$this->url);
      if ($json_string) {
        $scores = json_decode($json_string, true);
        return isset($scores)? $scores[0] : false;
      }
    } catch (Exception $e) {
      echo "Could not get Facebook count of URL $this->url\n";
      return false;
    }
  }

  private function file_get_contents_curl($url){
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
    $cont = curl_exec($ch);
    if(curl_error($ch))
    {
      return false;
    }
    return $cont;
  }

}
?>
