<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePostUserRelationshipTableToAddAndPopulatePostIdField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    // populate post_id
    $usersPosts = DB::table('post_user')->get();
    foreach ($usersPosts as $key => $record) {
      $postID = DB::table('posts')->where('post_url', $record->post_url)->first()->post_id;
      DB::table('post_user')
            ->where('post_url', $record->post_url)
            ->update(array('post_id' => $postID));
    }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$all = DB::table('post_user')->get();
    foreach ($all as $key => $record) {
      $record->update(array('post_id' => 0));
    }
	}

}
