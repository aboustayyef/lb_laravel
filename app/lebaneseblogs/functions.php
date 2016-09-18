<?php 

// Page Location
function page_is_search(){
	return Session::get('pageKind') == 'searchResults';
}
function page_is_channel(){
	return Session::get('pageKind') == 'channel';
}
function page_is_main(){
	return Session::get('pageKind') == 'allPosts';
}
function page_is_blogger(){
	return Session::get('pageKind') == 'blogger';
}


// Counting Cards
function current_card(){
	return Session::get('cardsCounter');
}
function increase_card_count($inc = 1){
	Session::set('cardsCounter', Session::get('cardsCounter') + $inc);
}

// Logging 
function lb_log($message="Default Message", $file='lebaneseBlogs.log')
{
  try {
    $logfile = storage_path() . '/logs/' . $file;
    $resource = fopen($logfile, 'a');
    $now = (new Carbon\Carbon)->format("Y-M-d H:i:s");
    $message = "$now - $message \n";
    fwrite($resource, $message);
    return true;
  } catch (Exception $e) {
    return false;
  }
}