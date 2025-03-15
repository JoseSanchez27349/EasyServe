<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMeseroIdToPedidosTable extends Migration
{
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            if (!Schema::hasColumn('pedidos', 'mesero_id')) {
                $table->foreignId('mesero_id')->constrained('meseros')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['mesero_id']);
            $table->dropColumn('mesero_id');
        });
    }
}