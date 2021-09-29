<x-slot name="header">
    <x-page-title>The Main Stock </x-page-title>
</x-slot>

<x-page-body>
    <x-card>
        <x-table-title>
            <a href="{{ route('stock.create') }}">
                <x-btn-new>+</x-btn-new>
            </a>
            Main Stock History
        </x-table-title>

        <x-table>
            <x-table-head>
                <th>Batch Number</th>
                <th>Date</th>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Expire Date</th>
                <th></th>
                <th></th>

            </x-table-head>
            <x-table-body>
                @foreach( $stocks as $stock )
                <tr>

                    <td>{{ $stock->number }}</td>
                    <td>{{ $stock->date }}</td>
                    <td>{{ "{$stock->product->product_details} {$stock->product->unit_details}" }}</td>
                    <td>{{ $stock->unit_price }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>{{ $stock->expire_date }}</td>


                    <td>
                        <a href="{{ route('stock.edit', $stock) }}">
                            <x-btn-edit>Edit</x-btn-edit>
                        </a>
                    </td>
                    <td>
                        <x-btn-delete wire:click.prevent='deleteStock({{ $stock }})'> X </x-btn-delete>

                    </td>
                </tr>

                @endforeach
            </x-table-body>
        </x-table>

    </x-card>
</x-page-body>
