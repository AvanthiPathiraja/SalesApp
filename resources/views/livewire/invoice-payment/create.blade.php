
<x-page-body>
<x-card>

   <div class="grid grid-cols-6 gap-3 gap-x-4">

    <x-lable class=" col-span-2">
        <span>Customer</span>
        <x-select wire:model="customer_id">
            <option value=""></option>
            @foreach ( $customers as $customer )
            <option value="{{ $customer->id }}">
                {{ $customer->name }}
            </option>
            @endforeach
        </x-select>
        <x-form-error for="customer_id" />
    </x-lable>

                <x-lable>
                    <span>Invoice Number</span>
                    <x-text-input wire:model="invoice_id" />
                    <x-form-error for="invoice_id" />
                </x-lable>

                <x-lable>
                    <span>Payment Date</span>
                    <x-text-input wire:model="date" />
                    <x-form-error for="date" />
                </x-lable>

                <x-lable>
                    <span>Reciept Number</span>
                    <x-text-input wire:model="number" />
                    <x-form-error for="number" />
                </x-lable>

        <x-lable>
            <span>Type</span>
            <x-text-input wire:model="type" />
            <x-form-error for='type' />
        </x-lable>

        <x-lable>
            <span>Amount</span>
            <x-text-input wire:model="amount" />
            <x-form-error for='amount' />
        </x-lable>

        <x-lable>
            <span>Note</span>
            <x-text-input wire:model="note" />
            <x-form-error for="note" />
        </x-lable>

        <x-form-footer class="col-span-6">
            <x-flash-msg type="success" key="success" />
            <x-btn-primary wire:click.prevent='addInvoicePayment()'>
                Save
            </x-btn-primary>
        </x-form-footer>

    </div>

            <x-table-title>
                Invoice Payment History
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

