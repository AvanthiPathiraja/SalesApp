<?php

namespace App\Http\Livewire\IssueReturn;

use Livewire\Component;
use App\Models\IssueReturn;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;

    public $search;
    protected $listeners = ['search'];


    public function search($val)
    {
        $this->search = '%'.$val.'%';
    }

    public function render()
    {
        $issue_returns = IssueReturn::where(function($invoice_return){
            $invoice_return
            ->where('date','like','%'.$this->search.'%')
            ->orWhere('quantity','like','%'.$this->search.'%')
            ->orWhere('reason','like','%'.$this->search.'%');
        })
        ->orWhere(function($related_data){
            $related_data
            ->whereHas('distributor',function ($distributor){
                $distributor
                ->where(DB::raw('concat(title," ",first_name," ",last_name)'),'like','%'.$this->search.'%');
            });
        })
        ->orWhere(function($related_data){
            $related_data
            ->whereHas('stock',function ($stock){
                $stock
                ->where('number','like','%'.$this->search.'%')
                ->orWhere(function($related_data){
                    $related_data
                    ->whereHas('product',function($product){
                        $product
                        ->where('category','like','%'.$this->search.'%')
                        ->orWhere('name','like','%'.$this->search.'%');
                    });
                });
            });
        })


        ->paginate(10);

        return view('livewire.issue-return.index')
            ->with(['issue_returns' => $issue_returns ]);
    }
}
