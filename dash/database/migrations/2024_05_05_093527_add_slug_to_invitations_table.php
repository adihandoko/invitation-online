<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToInvitationsTable extends Migration
{
    public function up()
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('event_category_id');
        });
    }

    public function down()
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
