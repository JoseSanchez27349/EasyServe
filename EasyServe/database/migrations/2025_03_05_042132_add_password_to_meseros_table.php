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
            $table->string('password')->after('nombre'); // Agrega el campo 'password'
        });
    }
    
    public function down()
    {
        Schema::table('meseros', function (Blueprint $table) {
            $table->dropColumn('password'); // Elimina el campo 'password' si se revierte la migración
        });
    }
};
