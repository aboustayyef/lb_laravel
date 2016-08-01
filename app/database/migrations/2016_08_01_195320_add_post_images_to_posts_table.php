<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPostImagesToPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			$table->renameColumn('post_image', 'post_original_image');
			$table->string('post_local_image')->nullable();
		});

		// Fill data of the last few days in the new table
		$twodaysago = (new Carbon\Carbon)->subDays('2')->timestamp;
		$posts = Post::where('post_timestamp','>',$twodaysago)->get();
		$posts->each(function($post){
			$filename = public_path() . '/img/cache/' . $post->post_timestamp . '-' .$post->post_id. '.jpg';
			if (file_exists($filename)) {
				$post->post_local_image = $post->post_timestamp . '-' .$post->post_id;
				$post->save();
			}
		});

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			$table->renameColumn('post_original_image','post_image');
			$table->dropColumn('post_local_image');
		});
	}

}
