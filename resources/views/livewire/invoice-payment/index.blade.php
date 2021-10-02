<x-page-body>
    <x-card>
        <x-table-title>
            <a href="{{ route('invoice-payment.create') }}">
                <x-btn-new>+</x-btn-new>
            </a>
            Payment Reciepts

            <x-search-input wire:model="search_key" placeholder="Search"/>
            <x-btn-primary wire:click.prevent="searchPayments"> Go </x-btn-primary>
        </x-table-title>

        <x-table>
            <x-table-head>
                <th>Reciept Number</th>
                <th>Reference</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Payment Type</th>
                <th>Amount</th>
                <th>Note</th>
                <th></th>
                <th></th>
            </x-table-head>
            <x-table-body>
                @foreach( $invoice_payments as $invoice_payment )
                <tr>
                    <td>{{ $invoice_payment->number }}</td>
                    <td>{{ $invoice_payment->reference }}</td>
                    <td>{{ $invoice_payment->date }}</td>
                    <td>{{ $invoice_payment->customer->name }}</td>
                    <td>{{ $invoice_payment->payment_type }}</td>
                    <td>{{ $invoice_payment->amount }}</td>
                    <td>{{ $invoice_payment->note }}</td>
                     <td>
                        <x-btn-delete wire:click.prevent="deleteInvoicePayment({{ $invoice_payment }})"> X
                        </x-btn-delete>

                    </td>
                </tr>

                @endforeach
            </x-table-body>
        </x-table>

    </x-card>
</x-page-body>
