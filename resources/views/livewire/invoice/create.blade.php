

<x-page-body>
    <x-card>

        <x-table-top>
            <div class=" flex space-x-2">
                <a href="{{ route('invoice.index') }}">
                    <x-btn-back/>
                </a>
                <x-table-top-title>Invoice Info </x-table-top-title>
            </div>
        </x-table-top>

        <div class="grid grid-cols-5 gap-3 gap-x-4">

            <x-lable>
                <span>Invoice Number</span>
                <x-text-input wire:model="number" />
                <x-form-error for="number" />
            </x-lable>

            <x-lable>
                <span>Reference</span>
                <x-text-input wire:model="reference" />
                <x-form-error for="reference" />
            </x-lable>

            <x-lable>
                <span>Invoice Date</span>
                <x-text-input wire:model="date" />
                <x-form-error for="date" />
            </x-lable>

            <x-lable class=" col-span-2">
                <span>Customer</span>
                <x-select wire:model="customer_id">
                    <option value=""></option>
                    @foreach ( $customers as $customer )
                    <option value="{{ $customer->id }}">
                        {{ "{$customer->number} - {$customer->name}" }}
                    </option>
                    @endforeach
                </x-select>
                <x-form-error for="customer_id" />
            </x-lable>

            <x-lable class=" col-span-2">
                <span>Distributor</span>
                <x-select wire:model="distributor_id">
                    <option value=""></option>
                    @foreach ( $distributors as $distributor )
                    <option value="{{ $distributor->id }}">
                        {{ "{$distributor->number} - {$distributor->full_name}" }}
                    </option>
                    @endforeach
                </x-select>
                <x-form-error for="distributor_id" />
            </x-lable>

            <br>
            <hr class=" col-span-5">

            <x-lable class=" col-span-3">
                <span>Product</span>
                <x-select wire:model="stock_id">
                    <option value=""></option>
                     @foreach ( $distributor_cusrrent_stock as $stock )
                        <option value="{{ $stock['stock_id'] }}">
                            {{ "{$stock['stock_number']} - {$stock['product_details']}" }}
                        </option>
                        @endforeach
                </x-select>
                <x-form-error for='stock_id' />
            </x-lable>

            <x-lable>
                <span>Quantity available</span>
                <x-text-input wire:model="quantity_available"  readonly/>
            </x-lable>

            <x-lable>
                <span>Unit Price</span>
                <x-text-input wire:model="unit_price" />
                <x-form-error for='unit_price' />
            </x-lable>

            <x-lable>
                <span>Unit Discount</span>
                <x-text-input wire:model="unit_discount" />
                <x-form-error for='unit_discount' />
            </x-lable>

            <x-lable>
                <span>Quantity</span>
                <x-text-input wire:model="quantity" />
                <x-form-error for="quantity" />
            </x-lable>

           <x-lable class="mt-5 m-2">
            <span></span>
                <x-checkbox-input type="checkbox" wire:model="is_free" /> Given For Free
            </x-lable>



            <x-form-footer class="col-span-5">
                <x-flash-msg type="success" key="successInvoiceItem" />
                <x-flash-msg type="error" key="dupplicateStockId" />
                <x-flash-msg type="error" key="invalidQuantity" />
                <x-btn-primary wire:click.prevent='addInvoiceItemToList()'>Add</x-btn-primary>
            </x-form-footer>

        </div>

        <x-table-top-title> Invoice Item List </x-table-top-title>

        <x-table class=" mt-3 mb-3">
            <x-table-head>
                <th>Batch Number</th>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Unit Discount</th>
                <th>Quantity</th>
                <th>Is free</th>
                <th>Total</th>
                <th></th>
            </x-table-head>
            <x-table-body>
                @if ($invoice_items)

                @foreach ( $invoice_items as $key => $item )
                <tr>
                    <td> {{ $item['stock_number'] }} </td>
                    <td> {{ $item['product_details'] }} </td>
                    <td> {{ $item['unit_price'] }} </td>
                    <td> {{ $item['unit_discount'] }} </td>
                    <td> {{ $item['quantity'] }} </td>
                    <td> {{ $item['is_free']  ? 'Yes' : 'No' }} </td>
                    <td> {{ $item['line_total'] }} </td>

                    <td>
                        <x-btn-delete wire:click.prevent="removeInvoiceItemFromList({{ $key }})"> X </x-btn-delete>
                    </td>
                </tr>
                @endforeach
                @endif

            </x-table-body>
        </x-table>

        <div class=" flex space-x-2">
            <span>Sub Total</span>
        <label>{{ $total_price }} </label>
        </div>
        <div class=" flex space-x-2">
            <span>Sub Discount</span>
        <label>{{ $total_discount }} </label>
        </div>

        <x-form-footer>
            <x-flash-msg type="success" key="successInvoice" />
            <x-flash-msg type="error" key="errorInvoice" />
            <x-btn-primary wire:click.prevent='saveOrUpdateInvoice()'>
                {{ $invoice ? 'Update Invoice' : 'Save Invoice' }}
            </x-btn-primary>
        </x-form-footer>

    </x-card>
</x-page-body>
