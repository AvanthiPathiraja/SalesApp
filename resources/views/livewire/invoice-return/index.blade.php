<x-page-body>

        <x-table-top>
            <div class=" flex space-x-2">
            <a href="{{ route('invoice-return.create') }}">
                <x-btn-new/>
            </a>
            <x-table-top-title> Invoice Returns </x-table-top-title>
        </div>
        <div>
            <livewire:search-input>
        </div>
        </x-table-top>

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
            </x-table-head>

            <x-table-body>
                @foreach( $invoice_returns as $invoice_return )
                <x-tbody-tr>
                    <td>{{ $invoice_return->invoice->number }}</td>
                    <td>{{ $invoice_return->date }}</td>
                    <td>{{ $invoice_return->invoice->customer->name }}</td>
                    <td>{{ $invoice_return->stock->number }}</td>
                    <td>{{ $invoice_return->stock->product->product_details }}</td>
                    <td>{{ $invoice_return->quantity }}</td>
                    <td>{{ $invoice_return->reason }}</td>
                    <td>{{ $invoice_return->distributor->full_name }}</td>
                     <td>
                         <x-tbody-btn-col>
                        <x-btn-delete wire:click.prevent="deleteInvoiceReturn({{ $invoice_return }})"/>
                    </x-tbody-btn-col>
                    </td>
                </x-tbody-tr>

                @endforeach
            </x-table-body>
        </x-table>

   {{ $invoice_returns->links() }}
</x-page-body>
