<x-page-body>
    <x-card>

        <x-table-top>
            <div class=" flex space-x-2">
                <a href="{{ route('customer.index') }}">
                    <x-btn-back/>
                </a>
                <x-table-top-title>Client Info </x-table-top-title>
            </div>
        </x-table-top>
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
                <span>Reciept Number</span>
                <x-text-input wire:model="number" />
                <x-form-error for="number" />
            </x-lable>

            <x-lable>
                <span>Reference</span>
                <x-text-input wire:model="reference" />
                <x-form-error for="reference" />
            </x-lable>

            <x-lable>
                <span>Payment Date</span>
                <x-text-input wire:model="date" />
                <x-form-error for="date" />
            </x-lable>

            <x-lable>
                <span>Payment Type</span>
                <x-text-input wire:model="payment_type" />
                <x-form-error for='payment_type' />
            </x-lable>

            <x-lable>
                <span>Amount</span>
                <x-text-input wire:model="amount" />
                <x-form-error for='amount' />
            </x-lable>

            <x-lable class=" col-span-2">
                <span>Note</span>
                <x-text-input wire:model="note" />
                <x-form-error for="note" />
            </x-lable>

            <x-form-footer class="col-span-6">
                <x-flash-msg type="success" key="success" />
                <x-btn-primary wire:click.prevent='saveOrUpdateInvoicePayment()'>
                    Save
                </x-btn-primary>
            </x-form-footer>

        </div>

    </x-card>
</x-page-body>
