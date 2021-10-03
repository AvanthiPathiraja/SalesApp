<?php

namespace App\Http\Livewire\IssueReturn;

use App\Models\IssueReturn;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    protected $listners = ['search'];

    public function search($val)
    {
        $this->search = '%'.$val.'%';
    }

    public function render()
    {
        $issue_returns = IssueReturn::paginate(10);

        return view('livewire.issue-return.index')
            ->with(['issue_returns' => $issue_returns ]);
    }
}
