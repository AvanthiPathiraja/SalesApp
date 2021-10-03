<x-page-body>

        <x-table-top>
            <div class=" flex space-x-2">
            <a href="{{ route('stock.create') }}">
                <x-btn-new/>
            </a>
            <x-table-top-title> Main Stock </x-table-top-title>
        </div>
        <div>
            <livewire:search-input />
        </div>
        </x-table-top>

        <x-table>
            <x-table-head>
                <th>Batch Number</th>
                <th>Date</th>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Expire Date</th>
                <th></th>

            </x-table-head>
            <x-table-body>
                @foreach( $stocks as $stock )
                <x-tbody-tr>

                    <td>{{ $stock->number }}</td>
                    <td>{{ $stock->date }}</td>
                    <td>{{ $stock->product->product_details }}</td>
                    <td>{{ number_format($stock->unit_price,2) }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>{{ $stock->expire_date }}</td>


                    <td>
                        <x-tbody-btn-col>
                        <a href="{{ route('stock.edit', $stock) }}">
                            <x-btn-edit/>
                        </a>

                        <x-btn-delete wire:click.prevent='deleteStock({{ $stock }})'/>
                    </x-tbody-btn-col>
                    </td>
                </x-tbody-tr>

                @endforeach
            </x-table-body>
        </x-table>

    {{ $stocks->links() }}
</x-page-body>
