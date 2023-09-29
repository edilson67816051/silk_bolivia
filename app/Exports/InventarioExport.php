<?php

namespace App\Exports;

use App\Models\Entrada_salida;
use App\Models\Producto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class InventarioExport implements  FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;
    public function __construct($id)
    {   $this->id = $id;
        
    }
    public function view():View
    {    
        return view('inventarioExcel',[
            'inventarios' =>  Entrada_salida::where('producto_id', $this->id)->get(),
            'producto' =>  Producto::find($this->id)
        ]);
    }
}