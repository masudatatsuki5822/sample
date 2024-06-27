<?php

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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('nursery_id');
            $table->integer('class_id');
            $table->integer('user_id');
            $table->timestamp('today');
            $table->double('temp');
            $table->timestamp('back_time');
            $table->string('person',255);
            $table->string('breakfast',255);
            $table->string('comment',700);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
