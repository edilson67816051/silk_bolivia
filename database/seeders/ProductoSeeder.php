<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::Create([
            'producto'=>'Calzado',
            'unidad_medida'=>'Unidad',
        ]);

        Producto::Create([
            'producto'=>'Shor',
            'unidad_medida'=>'Unidad',
        ]);

        $productos = [
            'Zapatos deportivos',
            'Camiseta de algodón',
            'Pantalones vaqueros',
            'Sombrero de ala ancha',
            'Calcetines de lana',
            'Reloj de pulsera',
            'Bufanda de seda',
            'Gafas de sol',
            'Mochila resistente',
            'Guantes de cuero',
            'Abrigo de invierno',
            'Botas de senderismo',
            'Pulsera de plata',
            'Cinturón de cuero',
            'Pantalones cortos',
            'Sudadera con capucha',
            'Jersey de lana',
            'Gorra de béisbol',
            'Bolso de mano',
            'Chaqueta de cuero',
        ];
        
        foreach ($productos as $nombreProducto) {
            Producto::create([
                'producto' => $nombreProducto,
                'unidad_medida' => 'Unidad',
            ]);
        }
    }
}