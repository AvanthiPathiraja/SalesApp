<?php

namespace App\Http\Livewire\IssueReturn;

use Livewire\Component;
use App\Models\Employee;
use App\Models\IssueItem;
use App\Models\IssueReturn;

class Create extends Component
{
    public $distributors = [];
    public $distributor_id;

    public $issue_items = [];
    public $issue_item_id,$stock_id,$issue_item_balance;

    public $issue_return,$issue_return_id,$date,$quantity,$reason,$is_reusable;


    public function mount()
    {
        $this->distributors = Employee::where('is_active',1)->get();
    }

    public function updatedDistributorId()
    {
        $this->issue_items = IssueItem::all();
        $this->stock_id = 1;
    }

    public function saveOrUpdateIssueReturn()
    {

        $validated_data = $this->validate([
            'date' => 'required|date',
            'distributor_id' => 'required|numeric',
            'issue_item_id' => 'required|numeric',
            'stock_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
            'reason' => 'required'
        ]);

        IssueReturn::create($validated_data);
        session()->flash('success','Completed Successfully !');
    }

    public function deleteIssueReturn(IssueReturn $issue_retun)
    {
        $issue_retun->delete();
        return redirect()->route('issue-return.index');
    }

    public function render()
    {
        return view('livewire.issue-return.create');
    }
}
