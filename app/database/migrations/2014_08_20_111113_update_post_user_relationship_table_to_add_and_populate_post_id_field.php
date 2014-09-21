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
		// Add the user_id column
    Schema::table('post_user', function($table)
    {
        $table->integer('post_id')->unsigned();
    });

    // populate it
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
		Schema::table('post_user', function($table)
    {
        $table->dropColumn('post_id');
    });
	}

}
