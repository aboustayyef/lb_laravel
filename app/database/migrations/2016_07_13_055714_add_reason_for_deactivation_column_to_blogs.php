<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddReasonForDeactivationColumnToBlogs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blogs', function(Blueprint $table)
		{
			$table->string('reason_for_deactivation')->nullable();
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
			$table->dropColumn('reason_for_deactivation');
		});
	}

}
