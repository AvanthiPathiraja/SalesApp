<x-page-body>
    <x-card>
        <x-table-title>
            <a href="{{ route('issue-note.create') }}">
                <x-btn-new>+</x-btn-new>
            </a>
            Issue Note History
        </x-table-title>

        <x-table>
            <x-table-head>
                <th>Issue Note Number</th>
                <th>Date</th>
                <th>Reference</th>
                <th>Distributor</th>
                <th></th>
                <th></th>

            </x-table-head>
            <x-table-body>
                @foreach( $issue_notes as $issue_note )
                <tr>

                    <td>{{ $issue_note->number }}</td>
                    <td>{{ $issue_note->date }}</td>
                    <td>{{ $issue_note->reference }}  </td>
                    <td>{{ $issue_note->distributor->full_name }}</td>

                    <td>
                        <a href="{{ route('issue-note.edit',$issue_note) }}">
                            <x-btn-edit>Edit</x-btn-edit>
                        </a>
                    </td>
                    <td>
                        <x-btn-delete wire:click.prevent='deleteIssueNote({{ $issue_note }})'> X </x-btn-delete>
                    </td>

                </tr>

                @endforeach
            </x-table-body>
        </x-table>


    </x-card>
</x-page-body>
