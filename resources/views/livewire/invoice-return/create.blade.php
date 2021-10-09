<x-page-body>
    <x-card>

        <x-table-top>
            <div class=" flex space-x-2">
                <a href="{{ route('invoice-return.index') }}">
                    <x-btn-back/>
                </a>
                <x-table-top-title>Customer Returns Info </x-table-top-title>
            </div>
        </x-table-top>
        <div class="grid grid-cols-6 gap-3 gap-x-4">

            <x-lable>
                <span>Invoice Number</span>
                <x-text-input wire:model="invoice_number" />
                <x-flash-msg type="error" key="invalidInvoice" />
                <x-form-error for="invoice_number" />
            </x-lable>

            <x-btn-reset wire:click.prevent='loadInvoice'>Check Invoice Details</x-btn-reset>

            <x-lable>
                <span>Reference</span>
                <x-text-input wire:model="invoice_reference" readonly />
             </x-lable>
             <x-lable>
                <span>Date</span>
                <x-text-input wire:model="invoice_date" readonly />
             </x-lable>
             <x-lable class=" col-span-2">
                <span>Customer</span>
                <x-text-input wire:model="invoice_customer" readonly />
             </x-lable>

        </div>
        <hr class=" mt-2 mb-2 col-span-6">

        <div class="grid grid-cols-6 gap-3 gap-x-4">

             <x-lable>
                <span>Returned Date</span>
                <x-text-input wire:model="date" />
                <x-form-error for="date" />
            </x-lable>

             <x-lable class=" col-span-3">
                <span>Product Returned</span>
                <x-select wire:model="invoice_item_id">
                    <option value=""></option>
                    @foreach($invoice_items as $invoice_item )
                        <option value="{{ $invoice_item->id }}">
                            {{ "{$invoice_item->stock->number} - {$invoice_item->stock->product->product_details}" }}
                        </option>
                    @endforeach
                </x-select>
                <x-form-error for="invoice_item_id" />
            </x-lable>

            <x-lable>
                <span>Invoiced Quantity</span>
                <x-text-input wire:model="invoice_quantity" readonly />

             </x-lable>

            <x-lable>
                <span>Returned Quantity</span>
                <x-text-input wire:model="quantity" />
                <x-form-error for='quantity' />
            </x-lable>

            <x-lable class=" col-span-2">
                <span>Reason</span>
                <x-select wire:model="reason">
                    <option value=""></option>
                    <option value="Expired"> Expired </option>
                    <option value="Damaged"> Damaged </option>
                    <option value="Unsold"> Unsold </option>
                    <option value="Other"> Other </option>
                </x-select>
                <x-form-error for='reason' />
            </x-lable>

            <x-lable>
                <x-checkbox-input wire:model="is_reusable" value="1" />
                Is Resusable
            </x-lable>

            <x-lable class=" col-span-2">
                <span>Collected Distributor</span>
                <x-select wire:model="distributor_id">
                    <option value=""></option>
                    @foreach ( $distributors as $distributor )
                    <option value="{{ $distributor->id }}">
                        {{ $distributor->full_name }}
                    </option>
                    @endforeach
                </x-select>
                <x-form-error for="distributor_id" />
            </x-lable>

            <x-form-footer class="col-span-6">
                <x-flash-msg type="success" key="success" />
                <x-flash-msg type="error" key="invalidQuantity" />
                <x-flash-msg type="error" key="dupplicateStockId" />
                <x-btn-primary wire:click.prevent='saveInvoiceReturn()'>
                    Save
                </x-btn-primary>
            </x-form-footer>

        </div>

    </x-card>
</x-page-body>
