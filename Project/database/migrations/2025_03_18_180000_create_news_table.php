<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // عنوان خبر
            $table->text('content'); // متن خبر
            $table->string('image')->nullable(); // تصویر خبر
            $table->json('slider_images')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // نویسنده خبر
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->boolean('is_archived')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
