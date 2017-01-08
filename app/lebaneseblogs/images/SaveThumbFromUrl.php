<?php namespace LebaneseBlogs\Images;
use \Imagick;
class SaveThumbFromUrl
{
    private $url, $name;
    function __construct($url,$name)
    {
        $this->url = $url;
        $this->name = $name;
    }

    function save()
    {
        try{
            $image = new Imagick($this->url);
        }catch(\ImagickException $e){
            return false;
        }
        // $image = $image->flattenImages();
        $image->setFormat('JPEG');
        $image->cropThumbnailImage(100,100);
        $outFile = $_ENV['DIRECTORYTOPUBLICFOLDER'] . '/img/thumbs/' . $this->name .'.jpg';
        $image->writeImage($outFile);
    }
}

?>
