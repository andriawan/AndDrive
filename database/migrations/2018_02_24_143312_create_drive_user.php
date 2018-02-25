<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriveUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drive_user', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('email')->unique();
            $table->string('gid');
            $table->string('name');
            $table->string('family_name')->nullable();
            $table->string('given_name')->nullable();
            $table->char('locale',5);
            $table->string('gender')->nullable();
            $table->string('avatar_url');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drive_user');
    }
}
