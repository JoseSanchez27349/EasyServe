<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('meseros', function (Blueprint $table) {
            $table->string('nombre')->after('id'); // Agrega la columna "nombre"
            $table->string('password')->after('nombre'); // Agrega la columna "password"
        });
    }
    
    public function down()
    {
        Schema::table('meseros', function (Blueprint $table) {
            $table->dropColumn('nombre');
            $table->dropColumn('password');
        });
    }
};
