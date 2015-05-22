<?php namespace LebaneseBlogs\Utilities;

class Strings
{
  private $string;
  function __construct($string=null)
  {
    $this->string = $string;
  }

  public function IdFromUrl(){
    $url = $this->string;
    https://brainsforless.wordpress.com
    $url = preg_replace('#https?://|www#', '', $url);
    $urlParts = explode('.', $url);
    foreach ($urlParts as $key => $part) {
      if (!empty($part) && $part != 'blog' && $part != 'weblog') {
        return $part;
      }
    }
  }

  public static function isMostlyArabic($string){

    $length = strlen($string) + 0.001; //to avoid division by zero errors
    $latinCharacters = preg_match_all("/([ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz])/", $string);
    $ratioOfLatinCharacters = $latinCharacters / $length;

    if ($ratioOfLatinCharacters < 0.5){
        return true;
      }
      return false;
  }


  public function prepareTwitterLink($post){

    $byline = $post->blog->blog_author_twitter_username ? " by @".$post->blog->blog_author_twitter_username : "";
    $byline .= " via lebaneseblogs.com";
    $allowedTitleSize = 140 - strlen($byline) - 28; // urls count for 22 chars on twitter and we add space
    $byline = ' ' . $post->post_url . $byline;
    $postTitle = $post->post_title;
    if (strlen($postTitle) >= $allowedTitleSize) {
      $postTitle = substr($postTitle, 0, ($allowedTitleSize - 4)) . '... ';
    }
    $tweetExpression = $postTitle.$byline;
    $twitterUrl = urlencode($tweetExpression);
    $url = "https://twitter.com/intent/tweet?text=".$twitterUrl;
    return $url;

  }

}

?>
