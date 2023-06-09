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
        Schema::create('exam__questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->references('id')->on('exams');
            $table->foreignId('question_id')->references('id')->on('questions'); 
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
        Schema::dropIfExists('exam__questions');
    }
};
