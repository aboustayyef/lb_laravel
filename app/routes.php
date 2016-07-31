<?php

// blogger and post management routes
require_once(app_path().'/routes/manageRoutes.php');

// legacy routes
require_once(app_path().'/routes/legacyRoutes.php');

// api routes. Send data to other apps.
require_once(app_path().'/routes/apiRoutes.php');

// authentication routes for bloggers to sign in with twitter
require_once(app_path().'/routes/authRoutes.php');

// administration routes for superuser (me!) for actions like adding blogs
require_once(app_path().'/routes/adminRoutes.php');

// mobile version routes
require_once(app_path().'/routes/mobileRoutes.php');

// Ajax routes
require_once(app_path(). '/routes/ajaxRoutes.php');

// Static routes (about page... etc )
require_once(app_path(). '/routes/staticRoutes.php');

// Posts and Blogger Posts routes
require_once(app_path(). '/routes/postRoutes.php');

// redirect outgoing links, for exit link counting and registering

Route::get('exit', array(
    'uses'  => 'ExitController@lbExit'
));

/*
|---------------------------------------------------------------------
|   Last resort. handle url shortcuts, especially those carried forward from previous version
|---------------------------------------------------------------------
|   examples:
|   lebaneseblogs.com/beirutspring -> lebaneseblogs.com/blogger/beirutspring
|   lebaneseblogs.com/fashion -> lebanesbelogs.com/channel/fashion
 */

Route::get('{slug}', ['uses'  =>  'UrlController@redirect']);
