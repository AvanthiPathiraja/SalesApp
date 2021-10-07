<?php

namespace App\Http\Livewire\Route;

use App\Models\Route;
use Livewire\Component;

class Create extends Component
{
    public $distributor_route,$route_id,$name,$area_id,$note;

    public function mount()
    {
        if($this->distributor_route)
        {
            $this->distributor_route = Route::findOrFail($this->distributor_route);
            $this->route_id = $this->distributor_route->id;
            $this->name = $this->distributor_route->name;
            $this->area_id = $this->distributor_route->area_id;
            $this->note = $this->distributor_route->note;
        }
    }

    public function saveOrUpdateRoute()
    {
        $validated_data = $this->validate([
            'name' => 'required|max:70',
            'area_id' => 'nullable|numeric',
            'note' => 'nullable|max:150',
        ]);

        $this->distributor_route = Route::updateOrCreate(['id' => $this->route_id ?? null],$validated_data);
        $this->route_id = $this->distributor_route->id;
        session()->flash('success','Completed Successfully !');
    }

    public function resetRoute()
    {
        $this->reset(['distributor_route','route_id','name','area_id','note']);
    }
    public function deleteRoute(Route $distributor_route)
    {
        $distributor_route->delete();
        return redirect()->route('route.index');
    }

    public function render()
    {
        return view('livewire.route.create');
    }
}
