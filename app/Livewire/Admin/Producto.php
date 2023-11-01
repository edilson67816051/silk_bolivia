<?php

namespace App\Livewire\Admin;

use App\Exports\ProductoExport;
use App\Models\Catalago;
use App\Models\Entrada_salida;
use App\Models\Producto as ModelsProducto;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Producto extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $productos;

    public $codigo = "";
    public $catalago = "";
    public $image;
    public $id;
    public $url;

    public $id_select;


    public function render()
    {
        return view('livewire.admin.producto',[
            'product' => ModelsProducto::orderBy('id', 'asc')->paginate(5),
            'catalagos' =>Catalago::all()
        ])->layout('layouts.admin');
    }

    public function export()
    {
        return Excel::download(new ProductoExport, 'producto.xlsx');
    }



    public function save()
    {
        $this->validate([
            'codigo' => 'required',
            'catalago' => 'required',
        ]);

        $url = $this->image->store('productos', 'public');

        $produc = new ModelsProducto();
        $produc->catalago = $this->catalago;
        $produc->codigo = $this->codigo;
        $produc->img = $url;
        $produc->save();
        $this->clear();
    }
    public function edit($productoId)
    {
        $this->id = $productoId;

        $prod = ModelsProducto::find($productoId);
        $this->catalago = $prod->catalago;
        $this->codigo = $prod->codigo;
        $this->url = $prod->img;
    }

    

    public function update()
    {
        $this->validate([
            'codigo' => 'required',
            'catalago' => 'required',
        ]);
        $produc = ModelsProducto::find($this->id);
        $produc->catalago = $this->catalago;
        $produc->codigo = $this->codigo;
        if($this->image != null){
            Storage::disk('public')->delete($produc->img); 
            $url = $this->image->store('productos', 'public');
            $produc->img = $url;
        }
        $produc->update();
    }

    public function select($id)
    {
        $this->id_select = $id;
        $prod = ModelsProducto::find($id);
        $this->catalago = $prod->catalago;
        $this->codigo = $prod->codigo;
        $this->url = $prod->img;
    }

    public function clear()
    {
        $this->codigo = '';
        $this->catalago = '';
        $this->image = null;
        $this->id_select = null;
    }

    public function delete()
    {
        if ($this->id_select) {
            $prod = ModelsProducto::find($this->id_select);
            
            Storage::disk('public')->delete($prod->img); 
            $prod->delete();
            $entrada_salida = Entrada_salida::where('producto_id',$this->id_select)->get();
            foreach($entrada_salida as $item){
                $item->delete();
            }
            
        }
        
       

        
        $this->clear();
    }
}