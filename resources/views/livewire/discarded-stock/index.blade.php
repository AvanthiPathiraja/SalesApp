<x-page-body>

    <x-table-top>
        <div>
        <a href="{{ route('discarded-stock.create') }}">
            <x-btn-new/>
        </a>
        Discarded Stock
    </div>
    <div>
        <livewire:search-input>
    </div>
    </x-table-top>

    <x-table>
        <x-table-head>
            <th>Date</th>
            <th>Employee</th>
            <th>Batch Number</th>
            <th>Category</th>
            <th>Product</th>
            <th>Quantity Discarded</th>
            <th>Reason</th>
            <th></th>
        </x-table-head>

        <x-table-body>
            @foreach( $discarded_stocks as $discarded_stock )
            <x-tbody-tr>
                <td>{{ $discarded_stock->date }}</td>
                <td>{{ $discarded_stock->employee->full_name }}</td>
                <td>{{ $discarded_stock->stock->number }}</td>
                <td>{{ $discarded_stock->stock->product->category }}</td>
                <td>{{ $discarded_stock->stock->product->name }}</td>
                <td>{{ $discarded_stock->quantity }}</td>
                <td>{{ $discarded_stock->reason }}</td>

                 <td>
                     <x-tbody-btn-col>
                    <x-btn-delete wire:click.prevent="deleteDiscardedStock({{ $discarded_stock }})"/>
                </x-tbody-btn-col>
                </td>
            </x-tbody-tr>

            @endforeach
        </x-table-body>
    </x-table>

{{ $discarded_stocks->links() }}
</x-page-body>
