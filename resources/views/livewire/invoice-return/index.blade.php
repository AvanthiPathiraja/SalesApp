<x-page-body>
    <x-card>
        <x-table-title>
            <a href="{{ route('invoice-return.create') }}">
                <x-btn-new>+</x-btn-new>
            </a>
            Invoice Returns
        </x-table-title>

        <x-table>
            <x-table-head>
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Batch Number</th>
                <th>Product</th>
                <th>Quantity Returned</th>
                <th>Reason</th>
                <th>Collected Distributor</th>
                <th></th>
                <th></th>
            </x-table-head>
            <x-table-body>
                @foreach( $invoice_returns as $invoice_return )
                <tr>
                    <td>{{ $invoice_return->invoice->number }}</td>
                    <td>{{ $invoice_return->date }}</td>
                    <td>{{ $invoice_return->invoice->customer->name }}</td>
                    <td>{{ $invoice_return->stock->number }}</td>
                    <td>{{ $invoice_return->stock->product->product_details }}</td>
                    <td>{{ $invoice_return->quantity }}</td>
                    <td>{{ $invoice_return->reason }}</td>
                    <td>{{ $invoice_return->distributor->full_name }}</td>
                     <td>
                        <x-btn-delete wire:click.prevent="deleteInvoicePayment({{ $invoice_return }})">
                            X
                        </x-btn-delete>

                    </td>
                </tr>

                @endforeach
            </x-table-body>
        </x-table>

    </x-card>
</x-page-body>
