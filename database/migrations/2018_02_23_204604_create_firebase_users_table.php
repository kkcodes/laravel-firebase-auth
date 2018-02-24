<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirebaseUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firebase_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('sign_in_id');
            $table->string('source_id');
            $table->string('pic');
            $table->tinyInteger('active');
            $table->timestamps();
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firebase_users');
    }
}
