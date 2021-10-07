<?php

namespace App\Http\Livewire\Route;

use App\Models\Route;
use Livewire\Component;
use App\Http\Livewire\Route\Create as RouteCreate;
use Livewire\WithPagination;

class Index extends RouteCreate
{
    use WithPagination;

    public $search;
    protected $listeners = ['search'];

    public function search($val)
    {
        $this->search = $val;
    }

    public function render()
    {
        $distributor_routes = Route::where('is_active',1)
            ->where(function($route){
                $route
                ->where('name','like','%'.$this->search.'%')
                ->orWhere('area_id','like','%'.$this->search.'%')
                ->orWhere('note','like','%'.$this->search.'%');
            })
            ->paginate(10);

        return view('livewire.route.index')
            ->with(['routes' => $distributor_routes ]);
    }
}
