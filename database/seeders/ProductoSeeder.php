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
    }
}