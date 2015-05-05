<?php namespace LebaneseBlogs\Utilities;

class Strings
{
  private $string;
  function __construct($string)
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

}

?>
