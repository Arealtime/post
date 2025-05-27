<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostAttachmentsTable extends Migration
{
    public function up()
    {
        Schema::create('post_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained();
            $table->string('path', 100);
            $table->string('original_name', 100);
            $table->string('mime_type', 100);
            $table->integer('size');
            $table->string('extension', 10);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_attachments');
    }
}
