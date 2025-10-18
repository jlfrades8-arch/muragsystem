<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdopterEmailToRescuesTable extends Migration
{
    public function up()
    {
        Schema::table('rescues', function (Blueprint $table) {
            $table->string('adopter_email')->nullable()->after('image');
        });
    }

    public function down()
    {
        Schema::table('rescues', function (Blueprint $table) {
            $table->dropColumn('adopter_email');
        });
    }
}
