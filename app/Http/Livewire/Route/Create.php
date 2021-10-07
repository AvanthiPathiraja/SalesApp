<?php

namespace App\Http\Livewire\Route;

use App\Models\Route;
use Livewire\Component;

class Create extends Component
{
    public $route,$route_id,$name,$area_id,$note;

    public function mount()
    {
        if($this->route)
        {
            $this->route = Route::findOrFail($this->route);
            $this->route_id = $this->route->id;
            $this->name = $this->route->name;
            $this->area_id = $this->route->area_id;
            $this->note = $this->route->note;
        }
    }

    public function saveOrUpdateRoute()
    {
        $validated_data = $this->validate([
            'name' => 'required|max:70',
            'area_id' => 'nullable|numeric',
            'note' => 'nullable|max:150',
        ]);

        $this->route = Route::updateOrCreate(['id' => $this->route_id ?? null],$validated_data);
        $this->route_id = $this->route->id;
        session()->flash('success','Completed Successfully !');
    }

    public function resetRoute()
    {
        $this->reset(['route_id','name','area_id','note']);
    }
    public function deleteRoute(Route $route)
    {
        $route->delete();
        return redirect()->route('route.index');
    }

    public function render()
    {
        return view('livewire.route.create');
    }
}
