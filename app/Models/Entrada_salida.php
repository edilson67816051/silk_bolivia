<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada_salida extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'detalle', 'entrada_fisica', 'salida_fisica', 'saldo_fisico', 'costo_unit', 'entrada_boliviano', 'salida_boliviano', 'saldo_boliviano', 'producto_id'];

    

}