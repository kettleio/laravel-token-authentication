<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TodoDataStructure extends Migration {

	public function up() {
		
		Schema::create('lists', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('title');
			$table->timestamps();
		});

		Schema::create('todos', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('list_id');			
			$table->string('title');
			$table->timestamps();
		});

		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('password');
			$table->timestamps();
		});		
		
	}

	public function down() {
		Schema::drop('lists');
		Schema::drop('todos');
		Schema::drop('users');
	}

}
