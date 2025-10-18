<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAdopterColumnsFromRescues extends Migration
{
    public function up()
    {
        Schema::table('rescues', function (Blueprint $table) {
            if (Schema::hasColumn('rescues', 'adopter_email')) {
                $table->dropColumn('adopter_email');
            }
            if (Schema::hasColumn('rescues', 'adopter_name')) {
                $table->dropColumn('adopter_name');
            }
        });
    }

    public function down()
    {
        Schema::table('rescues', function (Blueprint $table) {
            $table->string('adopter_email')->nullable()->after('image');
            $table->string('adopter_name')->nullable()->after('adopter_email');
        });
    }
}
