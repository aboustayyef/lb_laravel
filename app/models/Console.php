<?php

class Console {

	public static function clear(){
		Cache::forever('console', '');
	}

	public static function log($string){
		Cache::forever('console', Cache::get('console'). $string . PHP_EOL);
	}

	public static function show(){
		print "========" . PHP_EOL . Cache::get('console') . "========" ;
	}

}