<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddBlogThumbColumnToBlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blogs', function(Blueprint $table)
		{
			$table->string('blog_thumb');
		});

		// populate initial values: same as blog_id;
		Blog::all()->each(function($blog){
			$blog->blog_thumb = $blog->blog_id;
			$blog->save();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('blogs', function(Blueprint $table)
		{
			$table->dropColumn('blog_thumb');			
		});
	}

}
