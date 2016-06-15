<?php
use Symfony\Component\DomCrawler\Crawler ;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */


$routesPath = app_path().'/routes';

// Routes for posts (new)
include($routesPath.'/posts2.php');

// Api Routes
include($routesPath.'/api.php');


// Older Routes
// include($routesPath.'/old.php');
