<?php

/**
 * Lebanese Blogs administration. Adding Blogs
 */

class adminController extends BaseController
{

    function __construct()
    {
        # code...
    }

    public function getstep1(){
        return View::Make('admin.addBlog');
    }

    public function getstep2(){
        // Validation of step one before proceeding
        $rules = array(
            'url' =>  'required|url',
            'twitter' =>  'required|min:2'
        );

        $v = Validator::make(Input::all(), $rules);
        if ($v->fails()) {
            return Redirect::route('admin.getAddBlog')->withErrors($v)->withInput();
        }

        // Check if url has an RSS feed

        $url = Input::get('url');
        $metadata = new LebaneseBlogs\Crawling\MetaDataExtractor($url);
        if (!$metadata->success){
            return Redirect::route('admin.getAddBlog')->with('error', 'Blog doesn\'t exist or is empty');
        }
        $feed = $metadata->feed();
        if (!$feed){
            return Redirect::route('admin.getAddBlog')->with('error', 'Source has no RSS Feed!');
        } 
        return View::Make('admin.step2')->with('metadata',$metadata);
    }

    public function store(){
        $blog = new Blog;
        $blog->blog_id = Input::get('id');
        $blog->blog_name = Input::get('title');
        $blog->blog_description = Input::get('description');
        $blog->blog_url = Input::get('url');
        $blog->blog_author = "";
        $blog->blog_author_twitter_username = Input::get('twitter');
        $blog->blog_rss_feed = Input::get('feed');
        $blog->blog_tags = Input::get('tags');
        $blog->blog_RSSCrawl_active = 1;
        $blog->blog_last_post_timestamp = time();
        $blog->save();

        // now save image
        $image = new LebaneseBlogs\Images\SaveThumbFromUrl(Input::get('avatar'), Input::get('id'));
        $image->save();

        // redirect to main admin screen with success message
        return Redirect::to('admin/addBlog')->with('message', 'Blog Added!'); 
    }

}

?>
