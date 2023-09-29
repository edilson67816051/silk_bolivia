<?php

namespace App\Livewire\Admin;

use App\Exports\ProductoExport;
use App\Models\Producto as ModelsProducto;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;

class Producto extends Component
{
    use WithPagination;
    public $productos;

    public $nombreproducto = "";
    public $unidad = "";
    public $id;

    public $id_select;


    public function render()
    {
        return view('livewire.admin.producto',[
            'product' => ModelsProducto::orderBy('id', 'asc')->paginate(5)
        ])->layout('layouts.admin');
    }

    public function export()
    {
        return Excel::download(new ProductoExport, 'producto.xlsx');
    }



    public function store()
    {

        $this->validate([
            'nombreproducto' => 'required',
            'unidad' => 'required',
        ]);

        $produc = new ModelsProducto();

        $produc->producto = $this->nombreproducto;
        $produc->unidad_medida = $this->unidad;
        $produc->save();
        $this->clear();
    }
    public function edit($productoId)
    {
        $this->id = $productoId;

        $prod = ModelsProducto::find($productoId);
        $this->nombreproducto = $prod->producto;
        $this->unidad = $prod->unidad_medida;
    }

    public function update()
    {
        $this->validate([
            'nombreproducto' => 'required',
            'unidad' => 'required',
        ]);
        $produc = ModelsProducto::find($this->id);
        $produc->producto = $this->nombreproducto;
        $produc->unidad_medida = $this->unidad;
        $produc->update();
    }

    public function select($id)
    {
        $this->id_select = $id;
        $prod = ModelsProducto::find($id);
        $this->nombreproducto = $prod->producto;
        $this->unidad = $prod->unidad_medida;
    }

    public function clear()
    {
        $this->nombreproducto = '';
        $this->unidad = '';
        $this->id_select = null;
    }

    public function delete()
    {
        if ($this->id_select) {
            $prod = ModelsProducto::find($this->id_select);
            $prod->delete();
        }
        $this->clear();
    }
}