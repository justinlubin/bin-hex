<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeparateGamesInUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->integer('singleplayer_games')->after('games');
			$table->integer('multiplayer_games')->after('singleplayer_games');
			$table->dropColumn('games');
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
			$table->integer('games')->after('multiplayer_games');
			$table->dropColumn('singleplayer_games');
			$table->dropColumn('multiplayer_games');
		});
	}
}
