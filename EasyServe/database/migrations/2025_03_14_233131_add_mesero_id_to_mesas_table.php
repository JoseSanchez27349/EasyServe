<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMeseroIdToMesasTable extends Migration
{
    public function up()
    {
        Schema::table('mesas', function (Blueprint $table) {
            if (!Schema::hasColumn('mesas', 'mesero_id')) {
                $table->foreignId('mesero_id')->nullable()->constrained('meseros')->onDelete('set null');
            }
        });
    }

    public function down()
    {
        Schema::table('mesas', function (Blueprint $table) {
            $table->dropForeign(['mesero_id']);
            $table->dropColumn('mesero_id');
        });
    }
}