<?php

namespace App\Http\Livewire\IssueNote;

use Livewire\Component;
use App\Models\IssueNote;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\IssueNote\Create as IssueNoteCreate;

class Index extends IssueNoteCreate
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
        $issue_notes = IssueNote::where('is_active',1)
            ->where(function($issue_note){
                $issue_note
                    ->where('number','like','%'.$this->search.'%')
                    ->orWhere('date','like','%'.$this->search.'%')
                    ->orWhere('reference','like','%'.$this->search.'%');
            })
            ->orWhere(function($distributor){
                $distributor
                ->whereHas('distributor',function($distributor1){
                    $distributor1
                        ->where(DB::raw('concat(title," ",first_name," ",last_name)'),'like','%'.$this->search.'%');
                });
            })
            ->paginate(10);

        return view('livewire.issue-note.index')
            ->with(['issue_notes' => $issue_notes]);
    }
}
