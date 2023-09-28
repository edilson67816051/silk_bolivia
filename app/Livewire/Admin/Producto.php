<?php

namespace App\Livewire\Admin;

use App\Models\Producto as ModelsProducto;
use Livewire\Component;

class Producto extends Component
{
    public $productos;
    
    public $nombreproducto ="";
    public $unidad ="";
    public $id;

    public $id_select;
    
    
    public function render()
    {
        $this->productos = ModelsProducto::all();
        return view('livewire.admin.producto')->layout('layouts.admin');
    }

    

    public function store(){

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
    public function edit($productoId){
        $this->id = $productoId;
        
        $prod = ModelsProducto::find($productoId);       
        $this->nombreproducto = $prod->producto;
        $this->unidad = $prod->unidad_medida;
        
    }

    public function update(){
        $this->validate([
            'nombreproducto' => 'required',
            'unidad' => 'required',
        ]);
        $produc = ModelsProducto::find($this->id); 
        $produc->producto = $this->nombreproducto;
        $produc->unidad_medida = $this->unidad;
        $produc->update();
    }

    public function select($id){
        $this->id_select = $id;       
        $prod = ModelsProducto::find($id);       
        $this->nombreproducto = $prod->producto;
        $this->unidad = $prod->unidad_medida;
    }

    public function clear(){
        $this->nombreproducto = '';
        $this->unidad = '';
        $this->id_select=null; 
    }

    public function delete(){
        if($this->id_select){
            $prod = ModelsProducto::find($this->id_select);
            $prod->delete();
        }
        $this->clear();
       
    }
}