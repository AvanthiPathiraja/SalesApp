<x-page-body>

        <x-table-top>
            <div class=" flex space-x-2">
            <a href="{{ route('invoice-payment.create') }}">
                <x-btn-new/>
            </a>
            <x-table-top-title> Payment Reciepts </x-table-top-title>
        </div>
        <div>
            <livewire:search-input/>
        </div>
        </x-table-top>

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

            </x-table-head>

            <x-table-body>
                @foreach( $invoice_payments as $invoice_payment )
                <x-tbody-tr>
                    <td>{{ $invoice_payment->number }}</td>
                    <td>{{ $invoice_payment->reference }}</td>
                    <td>{{ $invoice_payment->date }}</td>
                    <td>{{ $invoice_payment->customer->name }}</td>
                    <td>{{ $invoice_payment->payment_type }}</td>
                    <td>{{ $invoice_payment->amount }}</td>
                    <td>{{ $invoice_payment->note }}</td>
                     <td>
                         <x-tbody-btn-col>
                        <x-btn-delete wire:click.prevent="deleteInvoicePayment({{ $invoice_payment }})"/>
                    </x-tbody-btn-col>
                    </td>
                </x-tbody-tr>

                @endforeach
            </x-table-body>
        </x-table>

    {{ $invoice_payments->links() }}
</x-page-body>
