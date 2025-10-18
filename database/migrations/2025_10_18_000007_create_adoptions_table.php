<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptionsTable extends Migration
{
    public function up()
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rescue_id')->constrained('rescues')->onDelete('cascade');
            $table->string('adopter_name')->nullable();
            $table->string('adopter_email')->nullable();
            $table->timestamp('adopted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('adoptions');
    }
}
