<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Catalago as ModelsCatalago;

class Catalago extends Component
{

    use WithPagination;

    public $nombrecatalago = "";
    public $id;

    public $id_select;


    public function render()
    {
        return view('livewire.admin.catalago', [
            'catalagos' => ModelsCatalago::orderBy('id', 'asc')->paginate(5)
        ])->layout('layouts.admin');
    }

    public function store()
    {
        $this->validate([
            'nombrecatalago' => 'required',
        ]);
        //dd($this->nombrecatalago);
        $cat = new ModelsCatalago();
        $cat->nombre = $this->nombrecatalago;
        $cat->save();
        $this->clear();
    }
    public function edit($catalagoId)
    {
        $this->id = $catalagoId;

        $cat = ModelsCatalago::find($catalagoId);
        $this->nombrecatalago = $cat->nombre;
    }

    public function update()
    {
        $this->validate([
            'nombrecatalago' => 'required',
        ]);
        $cat = ModelsCatalago::find($this->id);
        $cat->nombre = $this->nombrecatalago;
        $cat->update();
    }

    public function select($id)
    {
        $this->id_select = $id;
        $cat = ModelsCatalago::find($id);
        $this->nombrecatalago = $cat->nombre;
    }

    public function clear()
    {
        $this->nombrecatalago = '';
        $this->id_select = null;
    }

    public function delete()
    {
        if ($this->id_select) {
            $cat = ModelsCatalago::find($this->id_select);
            $cat->delete();
        }
        $this->clear();
    }
}