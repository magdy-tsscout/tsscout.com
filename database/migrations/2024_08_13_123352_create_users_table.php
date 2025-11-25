<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     public function up()
     {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('email')->unique()->default('');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('');
            $table->unsignedBigInteger('career_id')->nullable();
            $table->unsignedBigInteger('career_level')->nullable();
            $table->rememberToken();
            $table->timestamps();


        });
         Schema::table('users', function (Blueprint $table) {
             // Rename password_hash to password
            //  $table->renameColumn('password_hash', 'password');
         });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Rename password back to password_hash
            // $table->renameColumn('password', 'password_hash');
        });
    }
}
