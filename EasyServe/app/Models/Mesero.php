<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Extiende de Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mesero extends Authenticatable
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = ['nombre', 'password']; // Asegúrate de incluir 'password'

    // Campos que se ocultarán en las respuestas JSON (como la contraseña)
    protected $hidden = ['password'];

    // Relación con la tabla 'mesas'
    public function mesas()
    {
        return $this->hasMany(Mesa::class);
    }

    // Relación con la tabla 'pedidos'
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    // Sobrescribe el método para usar 'id' en lugar de 'email' como identificador
    public function getAuthIdentifierName()
    {
        return 'id'; // Usamos 'id' para la autenticación
    }
}