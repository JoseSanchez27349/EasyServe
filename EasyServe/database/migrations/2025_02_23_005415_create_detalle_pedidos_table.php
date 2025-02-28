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
    Schema::create('detalle_pedidos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('pedido_id');
        $table->string('item');  // Nombre del producto o platillo
        $table->integer('cantidad')->default(1);
        $table->decimal('precio', 8, 2);
        $table->timestamps();

        $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos');
    }
};
