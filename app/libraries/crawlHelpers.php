<?php
use Symfony\Component\DomCrawler\Crawler ;
use Guzzle\Http\Client;

class crawlHelpers extends BaseController
{

    function __construct()
    {
        # code...
    }

    // return content of a url
    public static function slurp($url){

      // use Guzzle to get http content

      // $client = new Client($url);
      // $request = $client->get('', [
      //             'headers' => [
      //                 'User-Agent' => 'lebblogs/3.1',
      //                 'Accept'     => 'text/html'
      //             ]]);
      // $response = $request->send();
      // $result = $response->getBody(true);
      // return $result;
      return @file_get_contents($url);
    }


    public static function getImageFromContent($content, $link=null){

      $imageContainer = new Crawler($content);
      $imageFound = self::getImageFromContainer($imageContainer, $link);
      if ($imageFound) {
        return $imageFound;
      } else {
        return self::getImageFromUrl($link);
      }
    }

    public static function getImageFromUrl($url)
    {
      // Prepare list of "main content tags by providers"
      $contentClasses = ['#main','.entry-content','.post-entry', '.entry', '.article_main_section', '.main-content', '#content', '.article'];
      if ($grossContent = @file_get_contents($url)){
        //proceed
      }else{
        // none of the methods succeeded
        return;
      };
      $grossContentCrawler = new Crawler($grossContent);

      // get root of url for images with relative paths
      $parsedUrl = parse_url($url);
      $root = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . '/';
      $root = rtrim($root, '/'); // remove trailing backslash.

      foreach ($contentClasses as $key => $class)
      {
        // Check if this class exists in DOM
        $crawlerCount = $grossContentCrawler->filter($class)->count();
        if ($crawlerCount > 0)
        {
          // the class exists, crawl it for images
          $imageContainer = $grossContentCrawler->filter($class);
          $imageFound = self::getImageFromContainer($imageContainer, $root);

          // return response
          if ($imageFound) {
            return $imageFound;
          }else{
            return false;
          }
        }
      }
      return false;
    }

    public static function getImageFromContainer(Crawler $imageContainer, $root = null)
    {
      // First, count images in container
      $images = $imageContainer->filter('img')->count();
      // if container has images, loop through them and pick the largest
      if ($images > 0)
      {
        $images = $imageContainer->filter('img');
        foreach ($images as $key => $image)
        {

          $imageNode = new Crawler($image);
          $tmpImage = $imageNode->attr('src');
          // if the image is relative, convert it to absolute
          if ($tmpImage[0] == '/') {
            $tmpImage = $root . $tmpImage;
          }

          // if image has width larger than 300 return image
          if (@getimagesize($tmpImage)) {
            echo 'candidate picture found: ' . $tmpImage ."\n";
            // remove url parameters from the end
            $tmpImage = preg_replace('#\?.+#', '', $tmpImage);
            list($width, $height, $type, $attr) = getimagesize($tmpImage);
            if ($width > 299)
            {
              return $tmpImage;
            } else {
              echo 'image too small'."\n";
            }
          }
        }
      }

      // check youtube
      $htmlContent = $imageContainer->html();

      preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $htmlContent, $matches);
      if(isset($matches[2]) && $matches[2] != '')
      {
        $YoutubeCode = $matches[2];
        $candidate = 'http://img.youtube.com/vi/'.$YoutubeCode.'/0.jpg';

        // check if image still exists
        if (@getimagesize($candidate)) {
          return $candidate;
        }
      }


      // check vimeo
      $htmlContent = $imageContainer->html();
      preg_match_all("#(?:https?://)?(?:\w+\.)?vimeo.com/(?:video/|moogaloop\.swf\?clip_id=)(\w+)#", $htmlContent, $results);
      if (isset($results[1][0])){
        $imgid = $results[1][0];
        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
        $candidate = $hash[0]['thumbnail_large'];

        // check if image exists
        if (@getimagesize($candidate)) {
          return $candidate;
        }
      }
    }

    // check vimeo


    public static function getImage($content, $link = null)
    {
      /*******************************************************************
      * First, try to extract from content of $content
      ********************************************************************/


      // testing
      $content = self::slurp($content);
      $crawler = new Crawler($content);
      $images = $crawler->filter('.site-content img');
      foreach ($images as $imageNode) {
        $img = new Crawler($imageNode);
        echo $img->attr('src')."\n";
      }
      return;
      // end testing


      $firstImage ="";
      $html = str_get_html($content);

      // First, check if the content has a usable (ie > 300px) image tag
      foreach ($html->find('img') as $img)
      {
        $image = $img->getAttribute('src');
        $image = normalizeImage($image);

        //check if image size is appropriate
        if (@getimagesize($image)) {
          list($width, $height, $type, $attr) = getimagesize("$image");
          if ($width>299) //only return images 300 px large or wider
          {
            $firstImage = $image;
            return $firstImage;
          }
        }

      }

      // if not, check if the content has usable youtube video
      $youtubePreview = get_youtube_thumb($content);
      if ($youtubePreview) {
        return $youtubePreview;
      }

      // try if there's a vimeo video
      $vimeoPreview = get_vimeo_thumb($content);
      if ($vimeoPreview) {
        return $vimeoPreview;
      }

      // If all above fails, we go scraping from source
      if (get_image_from_post($link)) {
        return get_image_from_post($link);
      }

    // if everything fails
    return false;
  }

}
