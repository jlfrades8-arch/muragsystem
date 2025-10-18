<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdopterNameToRescuesTable extends Migration
{
    public function up()
    {
        Schema::table('rescues', function (Blueprint $table) {
            $table->string('adopter_name')->nullable()->after('adopter_email');
        });
    }

    public function down()
    {
        Schema::table('rescues', function (Blueprint $table) {
            $table->dropColumn('adopter_name');
        });
    }
}
