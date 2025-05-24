<?php

use Arealtime\Post\App\Enums\PostTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->text('caption')->nullable();
            $table->enum('type', array_column(PostTypeEnum::cases(), 'value'))->default(PostTypeEnum::Photo->value);
            $table->string('location')->nullable();

            $table->unsignedInteger('like_count')->default(0);
            $table->unsignedInteger('comment_count')->default(0);
            $table->unsignedInteger('share_count')->default(0);

            $table->boolean('is_archived')->default(false);
            $table->boolean('is_pinned')->default(false);

            $table->timestamp('posted_at')->useCurrent();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
