<x-page-body>

    <x-table-top>
        <div class=" flex space-x-2">
        <a href="{{ route('issue-return.create') }}">
            <x-btn-new/>
        </a>
        <x-table-top-title> Distributor Stock Transactions </x-table-top-title>
    </div>
    <div>
        <x-select wire:model="distributor_id">
            <option value=""></option>
            @foreach ($distributors as $distributor)
                <option value="{{ $distributor->id }}">
                    {{ "{$distributor->number} - {$distributor->full_name}" }}
                </option>
            @endforeach)
        </x-select>
        <livewire:search-input>
    </div>
    </x-table-top>

    <x-table>
        <x-table-head>
            <th>Distributor</th>
            <th>Batch Number</th>
            <th>Product</th>
            <th>Issued Qty</th>
            <th>Customer Returned Qty</th>
            <th>Invoiced Qty</th>
            <th>Distributor Returned Qty</th>
            <th>Uncleared Balance</th>
            <th></th>
        </x-table-head>

        <x-table-body>
            @foreach( $distributor_stocks as $distributor_stock )
            <x-tbody-tr>
                <td>{{ $distributor_stock['stock_number'] }}</td>
                <td>{{ $distributor_stock['product_details'] }}</td>
                <td>{{ $distributor_stock['issued_qty'] }}</td>
                <td>{{ $distributor_stock['customer_returned_qty'] }}</td>
                <td>{{ $distributor_stock['invoiced_qty'] }}</td>
                <td>{{ $distributor_stock['distributor_returned_qty'] }}</td>
                <td>{{ $distributor_stock['due_balance'] }}</td>

                 <td>

                </td>
            </x-tbody-tr>

            @endforeach
        </x-table-body>
    </x-table>

{{-- {{ $distributor_stock_report->links() }} --}}
</x-page-body>
