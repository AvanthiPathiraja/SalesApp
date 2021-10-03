<x-page-body>

    <x-table-top>
        <div class=" flex space-x-2">
        <a href="{{ route('issue-return.create') }}">
            <x-btn-new/>
        </a>
        <x-table-top-title> Distributor Returns </x-table-top-title>
    </div>
    <div>
        <livewire:search-input>
    </div>
    </x-table-top>

    <x-table>
        <x-table-head>
            <th>Date</th>
            <th>Distributor</th>
            <th>Batch Number</th>
            <th>Product</th>
            <th>Quantity Returned</th>
            <th>Reason</th>
            <th></th>
        </x-table-head>

        <x-table-body>
            @foreach( $issue_returns as $issue_return )
            <x-tbody-tr>
                <td>{{ $issue_return->date }}</td>
                <td>{{ $issue_return->distributor->full_name }}</td>
                <td>{{ $issue_return->stock->number }}</td>
                <td>{{ $issue_return->stock->product->product_details }}</td>
                <td>{{ $issue_return->quantity }}</td>
                <td>{{ $issue_return->reason }}</td>

                 <td>
                     <x-tbody-btn-col>
                    <x-btn-delete wire:click.prevent="deleteIssueReturn({{ $issue_return }})"/>
                </x-tbody-btn-col>
                </td>
            </x-tbody-tr>

            @endforeach
        </x-table-body>
    </x-table>

{{ $issue_returns->links() }}
</x-page-body>
