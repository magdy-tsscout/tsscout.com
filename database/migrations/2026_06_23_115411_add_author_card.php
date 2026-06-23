<?php

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if(Schema::hasColumn('users', 'author_name') && Schema::hasColumn('users', 'author_card') && Schema::hasColumn('users', 'author_slug') && Schema::hasColumn('users', 'author_img')) {

            }else{
                $table->string('author_name')->nullable()->after('email');
                $table->string('author_card')->nullable()->after('author_name');
                $table->string('author_slug')->nullable()->after('author_card');
                $table->string('author_img')->nullable()->after('author_slug');
            }
        });

        Schema::table('blogs', function (Blueprint $table) {
            if( !Schema::hasColumn('blogs', 'author_id')) {

                $table->unsignedBigInteger('author_id')->nullable();
                // $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            }
        });


        User::where('user_id','>=', 1)->update([
            'author_name' => 'Sara H.',
            'author_card' => 'This is the default author card.',
            'author_slug' => 'sara-h',
            'author_img' => null,
        ]);

        Blog::query()->update(['author_id' =>1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('author_name');
            $table->dropColumn('author_card');
            $table->dropColumn('author_slug');
            $table->dropColumn('author_img');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
        });
    }
};
