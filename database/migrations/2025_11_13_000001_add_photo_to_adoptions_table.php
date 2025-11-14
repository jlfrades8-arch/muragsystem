<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotoToAdoptionsTable extends Migration
{
    public function up()
    {
        Schema::table('adoptions', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('adopter_email');
        });
    }

    public function down()
    {
        Schema::table('adoptions', function (Blueprint $table) {
            $table->dropColumn('photo');
        });
    }
}
