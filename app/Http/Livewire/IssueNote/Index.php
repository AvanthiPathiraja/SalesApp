<?php

namespace App\Http\Livewire\IssueNote;

use App\Models\IssueNote;
use Livewire\Component;
use App\Http\Livewire\IssueNote\Create as IssueNoteCreate;

class Index extends IssueNoteCreate
{
    public $issue_notes = [];

    public function mount()
    {
        $this->issue_notes = IssueNote::where('is_active',1)->get();
    }

    public function render()
    {
        return view('livewire.issue-note.index');
    }
}
