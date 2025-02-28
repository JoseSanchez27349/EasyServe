<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesero extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function mesas()
    {
        return $this->hasMany(Mesa::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
