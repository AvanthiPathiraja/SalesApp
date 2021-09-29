<x-slot name="header">
    <x-page-title> Invoices Info </x-page-title>
</x-slot>

<x-page-body>
        <x-card>
            <x-table-title >
                <a href="{{ route('invoice.create') }}">
                    <x-btn-new>+</x-btn-new>
                </a>
                Invoice List
            </x-table-title>

            <x-table>
                    <x-table-head>
                        <th>Invoice Number</th>
                        <th>Reference</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Distributor</th>
                        <th>Total Price</th>
                        <th>Total Discounts</th>
                        <th></th>
                        <th></th>
                    </x-table-head>
                  <x-table-body>
                    @foreach( $invoices as $invoice )
                    <tr>
                        <td>{{ $invoice->number }}</td>
                        <td>{{ $invoice->reference }}</td>
                        <td>{{ $invoice->date }}</td>
                        <td>{{ $invoice->customer->name }}</td>
                        <td>{{ $invoice->distributor_id }}</td>
                        <td>{{ $invoice->total_price }}</td>
                        <td>{{ number_format($invoice->total_discount) }}</td>

                        <td>
                            <a href="{{ route('invoice.edit', $invoice) }}"> <x-btn-edit>Edit</x-btn-edit> </a>
                        </td>
                        <td>
                            <x-btn-delete wire:click.prevent="deleteInvoice({{ $invoice }})"> X </x-btn-delete>

                        </td>
                    </tr>

                @endforeach
            </x-table-body>
                </x-table>

            </x-card>
        </x-page-body>
