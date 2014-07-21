<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatsToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->integer('games')->after('password');
			$table->integer('won')->after('games');
			$table->integer('lost')->after('won');
			$table->integer('best_time')->after('lost');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropColumn('games');
			$table->dropColumn('won');
			$table->dropColumn('lost');
			$table->dropColumn('best_time');
		});
	}
}
