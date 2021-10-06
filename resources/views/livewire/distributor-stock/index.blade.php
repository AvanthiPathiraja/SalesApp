
<x-page-body>

    <x-table-top>
        <div>
        <a href="{{ route('distributor-stock.create') }}">
            <x-btn-new/>
        </a>
        Distributor Stock
    </div>
    <div>
        <livewire:search-input>
    </div>
    </x-table-top>

    <x-table>
        <x-table-head>
            <th>Date</th>
            <th>Batch Number</th>
            <th>Category</th>
            <th>Product</th>
            <th>Quantity From Main Stock </th>
            <th>Quantity From Customer Returns </th>
            <th>Quantity Sold </th>
            <th>Quantity Remain </th>
            <th>Checked And Returned</th>
        </x-table-head>

        <x-table-body>
            @foreach( $distributor_stocks as $distributor_stock )
            <x-tbody-tr>
                <td>{{ $distributor_stock->date }}</td>
                <td>{{ $distributor_stock->employee->full_name }}</td>
                <td>{{ $distributor_stock->stock->number }}</td>
                <td>{{ $distributor_stock->stock->product->category }}</td>
                <td>{{ $distributor_stock->stock->product->name }}</td>
                <td>{{ $distributor_stock->quantity }}</td>
                <td>{{ $distributor_stock->reason }}</td>

                 <td>
                    <x-checkbox-input  wire:model='is_checked_and_returned'/>
                </td>
            </x-tbody-tr>

            @endforeach
        </x-table-body>
    </x-table>

{{ $discarded_stocks->links() }}
</x-page-body>
