<?php
use Symfony\Component\DomCrawler\Crawler ;
use Guzzle\Http\Client;
/**
*
*/
class ArticlesFetcherController extends BaseController
{

  function __construct()
  {
    # code...
  }

  function getArticles(){
    // create http client instance
    $client = new Client('https://now.mmedia.me');

    // create a request
    $request = $client->get('/lb/en/Author/Michael.Young');

    // send request / get response
    $response = $request->send();

    // this is the response body from the requested page (usually html)
    $result = $response->getBody(true);

    // (working Iteration example)
    //  $crawler = new Crawler($result);
    // foreach ($crawler->filter('.tbl_brd') as $node) {
    //   $crawler = new Crawler($node);
    //   echo $crawler->filter('a')->attr('href').' <br> ';
    // }

    $crawler = new Crawler($result);
    $crawler = $crawler->filter('.tbl_brd')->eq(0);
    $link = $crawler->filter('a')->attr('href');

    $client = new Client($link);
    $request = $client->get();
    $response = $request->send();
    $result = $response->getBody(true);

    $crawler = new Crawler($result);
    $title = $crawler->filter('#Content_Content_Content_lblArticleTitle')->eq(0)->text();
    $content = $crawler->filter('.main_txt')->first()->html();
    $image = $crawler->filter('#Content_Content_Content_mediaDiv img')->first()->attr('src');

  echo '<!DOCTYPE html>';
  echo '<html lang="en"
  <head>
    <meta charset="UTF-8">
    <title>Document</title>
  </head>
  <body>';
    echo $title;
    echo $image;
    echo $content;
  echo '
  </body>
  </html>';
  }
}
