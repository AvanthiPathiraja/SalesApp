<x-slot name="header">
    <x-page-title> Invoice Payment Info </x-page-title>
</x-slot>

<x-page-body>
        <x-card>
            <x-table-title >
                <a href="{{ route('invoice-payment.create') }}">
                    <x-btn-new>+</x-btn-new>
                </a>
                Invoice List
            </x-table-title>

            <x-table>
                    <x-table-head>
                        <th>Reciept Number</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Invoice Number</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Note</th>
                        <th></th>
                        <th></th>
                    </x-table-head>
                  <x-table-body>
                    @foreach( $invoice_payments as $invoice_payment )
                    <tr>
                        <td>{{ $invoice_payment->number }}</td>
                        <td>{{ $invoice_payment->date }}</td>
                        <td>{{ $invoice_payment->customer->name }}</td>
                        <td>{{ $invoice_payment->invoice->number }}</td>
                        <td>{{ $invoice_payment->type }}</td>
                        <td>{{ $invoice_payment->amount }}</td>
                        <td>{{ $invoice_payment->note }}</td>

                        <td>
                            <a href="{{ route('invoice-payment.edit', $invoice_payment) }}"> <x-btn-edit>Edit</x-btn-edit> </a>
                        </td>
                        <td>
                            <x-btn-delete wire:click.prevent="deleteInvoicePayment({{ $invoice_payment }})"> X </x-btn-delete>

                        </td>
                    </tr>

                @endforeach
            </x-table-body>
                </x-table>

            </x-card>
        </x-page-body>
