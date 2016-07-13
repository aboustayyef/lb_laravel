<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddBloggingFrequencyDataToBlogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blogs', function(Blueprint $table)
		{
			$table->integer('hours_bw_posts_median')->unsigned()->nullable();
			$table->integer('hours_bw_posts_average')->unsigned()->nullable();
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
			$table->dropColumn('hours_bw_posts_median');
			$table->dropColumn('hours_bw_posts_average');
		});
	}

}
