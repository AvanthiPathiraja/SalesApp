<x-page-body>

    <x-table-top>
        <div class=" flex space-x-2">
            <a href="{{ route('issue-note.create') }}">
                <x-btn-new/>
            </a>
            <x-table-top-title> Issue Notes </x-table-top-title>
        </div>
            <div>
                <livewire:search-input />
            </div>
        </x-table-top>

        <x-table>
            <x-table-head>
                <th>Issue Note Number</th>
                <th>Date</th>
                <th>Reference</th>
                <th>Distributor</th>
                <th></th>

            </x-table-head>
            <x-table-body>
                @foreach( $issue_notes as $issue_note )
                <x-tbody-tr>

                    <td>{{ $issue_note->number }}</td>
                    <td>{{ $issue_note->date }}</td>
                    <td>{{ $issue_note->reference }}  </td>
                    <td>{{ $issue_note->distributor->full_name }}</td>

                    <td>
                        <x-tbody-btn-col>
                        <a href="{{ route('issue-note.edit',$issue_note) }}">
                            <x-btn-edit/>
                        </a>

                        <x-btn-delete wire:click.prevent='deleteIssueNote({{ $issue_note }})'/>
                    </x-tbody-btn-col>
                    </td>

                </x-tbody-tr>

                @endforeach
            </x-table-body>
        </x-table>

{{ $issue_notes->links() }}
</x-page-body>
