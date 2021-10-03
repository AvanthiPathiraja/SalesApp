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
        dd($this->search);
    }

    public function render()
    {
        $issue_notes = IssueNote::where('is_active',1)
            ->where(DB::raw('concat(number,date)'),'like','%'.$this->search.'%')
            ->paginate(10);

        return view('livewire.issue-note.index')
            ->with(['issue_notes' => $issue_notes]);
    }
}
