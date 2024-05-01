<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToInvitationsTable extends Migration
{
    public function up()
{
    Schema::table('invitations', function (Blueprint $table) {
        $table->softDeletes();
    });
}

public function down()
{
    Schema::table('invitations', function (Blueprint $table) {
        $table->dropSoftDeletes();
    });
}

}
