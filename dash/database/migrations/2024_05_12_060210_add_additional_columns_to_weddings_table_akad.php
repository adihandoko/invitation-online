<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumnsToWeddingsTableAkad extends Migration
{
    public function up()
    {
        Schema::table('weddings', function (Blueprint $table) {
            // Modify 'akad_date' column to 'dateTime'
            $table->dateTime('akad_date')->nullable()->change();

            // Modify 'wedding_date' column to 'dateTime'
            $table->dateTime('wedding_date')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('weddings', function (Blueprint $table) {
            // Revert the changes
            $table->date('akad_date')->nullable()->change();
            $table->date('wedding_date')->nullable()->change();
        });
    }
}
