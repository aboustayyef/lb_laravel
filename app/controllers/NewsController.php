<?php
  /**
  *
  */
  class NewsController extends BaseController
  {

    public function index(){

      Session::put('pageKind', 'news');
      return View::make('news.main');

    }

  }

?>
