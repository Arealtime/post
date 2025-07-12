<?php

use Arealtime\Post\App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostLikesTable extends Migration
{
    public function up()
    {
        Schema::create('post_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->index();
            $table->foreignId('post_id')->constrained(Post::class);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_likes');
    }
}
