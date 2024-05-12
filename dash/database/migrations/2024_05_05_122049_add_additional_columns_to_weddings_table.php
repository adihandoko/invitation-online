<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumnsToWeddingsTable extends Migration
{
    public function up()
    {
        Schema::table('weddings', function (Blueprint $table) {
            $table->date('akad_date')->nullable();
            $table->date('wedding_date')->nullable();
            $table->string('ibu_mempelai_pria')->nullable();
            $table->string('ibu_mempelai_wanita')->nullable();
            $table->string('bapak_mempelai_pria')->nullable();
            $table->string('bapak_mempelai_wanita')->nullable();
        });
    }

    public function down()
    {
        Schema::table('weddings', function (Blueprint $table) {
            $table->dropColumn('akad_date');
            $table->dropColumn('wedding_date');
            $table->dropColumn('ibu_mempelai_pria');
            $table->dropColumn('ibu_mempelai_wanita');
            $table->dropColumn('bapak_mempelai_pria');
            $table->dropColumn('bapak_mempelai_wanita');
        });
    }
}
