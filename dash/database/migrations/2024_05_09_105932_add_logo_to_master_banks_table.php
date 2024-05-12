<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLogoToMasterBanksTable extends Migration
{
    public function up()
    {
        Schema::table('master_banks', function (Blueprint $table) {
            $table->string('logo_url')->nullable()->after('nama_bank');
        });
    }

    public function down()
    {
        Schema::table('master_banks', function (Blueprint $table) {
            $table->dropColumn('logo_url');
        });
    }
}
