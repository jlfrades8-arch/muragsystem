<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('feedback_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('feedback_id')->index();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->text('message');
            $table->timestamps();
            $table->foreign('feedback_id')->references('id')->on('feedbacks')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedback_replies');
    }
};
