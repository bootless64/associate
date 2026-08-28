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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // موضوع پروژه
            $table->text('description')->nullable(); // توضیحات پروژه
            $table->unsignedTinyInteger('time_progress')->default(0); // درصد پیشرفت زمانی (0 تا 100)
            $table->unsignedTinyInteger('task_progress')->default(0); // درصد پیشرفت عملی (0 تا 100)
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade'); // مشتری پروژه
            $table->foreignId('manager_id')->nullable()->constrained('users')->onDelete('set null'); // مسئول پروژه
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
