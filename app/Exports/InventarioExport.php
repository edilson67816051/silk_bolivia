<?php

namespace App\Exports;

use App\Models\Entrada_salida;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class InventarioExport implements  FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        return view('inventarioExcel',[
            'inventarios' => Entrada_salida::all()
        ]);
    }
}