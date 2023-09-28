<?php

namespace App\Livewire\Inventario;

use App\Models\Entrada_salida;
use Livewire\Component;
use App\Models\Producto;
use Illuminate\Validation\Rules\Exists;

use function PHPUnit\Framework\isNull;

class InventarioIndex extends Component
{
    public $showlist = false;    //dato a buscar
    public $search = "";    //Almacena los datos para sugerencia
    public $results;    //Almacena los datos a los que se hicieron click
    public $product;   //Obtener registros en la busqueda

    public $inventario;

    public $tipo, $valor, $detalle, $cantidad;

    public $costo_unit, $valor_total, $cantidad_total;

    public function mount()
    {
        $this->tipo = 'entrada'; // Establece 'entrada' como opción seleccionada por defecto
    }
    public function searchProduct()
    {
        if (!empty($this->search)) {
            $this->results = Producto::orderby('producto', 'asc')
                ->select('*')
                ->where('id', 'like', '%' . $this->search . '%')
                ->orwhere('producto', 'like', '%' . $this->search . '%')
                ->take(6)
                ->get();
            $this->showlist = true;
        } else {
            $this->showlist = false;
        }
    }
    public function getProduct($id = 0)
    {
        $result = Producto::select('*')
            ->where('id', $id)
            ->first();
        $this->search = $result->id;
        $this->product = $result;
        $this->showlist = false;

        $this->actualizar();
    }

    public function insert()
    {
        $this->validate([
            'valor' => 'required',
            'tipo' => 'required',
            'cantidad' => 'required',
        ]);

        $ul = Entrada_salida::orderby('updated_at', 'desc')
            ->select('*')
            ->where('producto_id', $this->search)
            ->first();
        if ($ul != null) {
            $valor_ul = $ul->valor_total;
            $cantidad_ul = $ul->cantidad_total;
        } else {
            $valor_ul = 0;
            $cantidad_ul = 0;
        }
        if ($this->tipo == "entrada") {
            $valor_total = $valor_ul + $this->valor;
            $cantidad_total = $cantidad_ul + $this->cantidad;
        } else {
            if ($this->tipo == "salida") {
                $valor_total = $valor_ul - $this->valor;
                $cantidad_total = $cantidad_ul - $this->cantidad;
            } else {

                $valor_total = $valor_ul - $this->valor;
                $cantidad_total = $cantidad_ul - $this->cantidad;
                $this->valor = ($this->valor) * -1;
                $this->cantidad = ($this->cantidad) * -1;
            }
        }

        $valor_unit = ($valor_total / $cantidad_total);

        //dd($cantidad,$valor,$cantidad_total,$valor_total,$valor_unit);

        $inventario = new Entrada_salida();
        $inventario->tipo = $this->tipo;
        $inventario->detalle = $this->detalle;
        $inventario->cantidad = $this->cantidad;
        $inventario->valor = $this->valor;
        $inventario->cantidad_total = $cantidad_total;
        $inventario->valor_total = $valor_total;
        $inventario->valor_unit =  $valor_unit;
        $inventario->producto_id = $this->search;
        $inventario->save();

        $this->actualizar();
    }

    public function actualizar()
    {
        $this->costo_unit = null;
        $this->valor_total = null;
        $this->cantidad_total = null;
        $this->inventario = Entrada_salida::where('producto_id', $this->search)
            ->latest('updated_at')
            ->limit(5)
            ->get();
        if (count($this->inventario) > 0) {
            $this->costo_unit = $this->inventario[0]->valor_unit;
            $this->valor_total = $this->inventario[0]->valor_total;
            $this->cantidad_total = $this->inventario[0]->cantidad_total;
        }
    }

    public function store()
    {
        $this->insert();
        $this->clear();
    }

    public function clear()
    {
        $this->detalle = null;
        $this->cantidad = null;
        $this->valor = null;
    }


    public function render()
    {

        return view('livewire.inventario.inventario-index')->layout('layouts.admin');
    }
}