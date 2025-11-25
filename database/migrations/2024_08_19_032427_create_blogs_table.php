<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Blog title
            $table->text('excerpt'); // Blog excerpt
            $table->string('author'); // Author's name
            $table->date('publish_date'); // Publish date
            $table->string('image'); // Blog image
            $table->integer('likes')->default(0); // Number of likes
            $table->json('content'); // JSON field to store content sections
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
