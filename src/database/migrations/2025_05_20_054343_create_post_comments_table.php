<?php

use Arealtime\Post\App\Console\Commands\Post;
use Arealtime\Post\App\Models\PostComment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->index();
            $table->foreignId('post_id')->constrained(Post::class);
            $table->foreignId('parent_id')->nullable()->constrained(PostComment::class)->onDelete('cascade');

            $table->text('content');

            $table->unsignedBigInteger('like_count')->default(0);

            $table->boolean('is_hidden')->default(false);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_comments');
    }
}
