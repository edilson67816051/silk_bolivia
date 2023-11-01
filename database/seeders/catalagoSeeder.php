<?php

namespace Database\Seeders;
use App\Models\Catalago;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class catalagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Catalago::Create([
            'nombre'=>'ART DESIGN',
        ]);
        Catalago::Create([
            'nombre'=>'PRESTIGE',
        ]);
        Catalago::Create([
            'nombre'=>'SOUTH',
        ]);
        Catalago::Create([
            'nombre'=>'EAST',
        ]);


        
    }
}