<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveRolFromMeserosTable extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('meseros', 'rol')) {
            Schema::table('meseros', function (Blueprint $table) {
                $table->dropColumn('rol');
            });
        }
    }

    public function down()
    {
        Schema::table('meseros', function (Blueprint $table) {
            $table->enum('rol', ['admin', 'mesero'])->default('mesero');
        });
    }
}