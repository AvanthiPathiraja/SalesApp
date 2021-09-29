

<x-page-body>
    <x-card>

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
                        {{ $customer->name }}
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
                        {{ $distributor->full_name }}
                    </option>
                    @endforeach
                </x-select>
                <x-form-error for="distributor_id" />
            </x-lable>

            <x-lable class=" col-span-4">
                <span>Invoiced Product</span>
                <x-select wire:model="issue_item_id">
                    <option value=""></option>
                    @foreach ( $issue_items as $issue_item )
                    <option value="{{ $issue_item->id }}">
                        {{ "{$issue_item->category} {$issue_item->name}" }}
                    </option>
                    @endforeach
                </x-select>
                <x-form-error for='issue_item_id' />
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

           <x-lable class="mt-5 m-2 col-span-2">
            <span></span>
                <x-checkbox-input type="checkbox" wire:model="is_free" /> Given For Free
            </x-lable>



            <x-form-footer class="col-span-6">
                <x-flash-msg type="success" key="successInvoiceItem" />
                <x-btn-primary wire:click.prevent='addInvoiceItemToList()'>Add</x-btn-primary>
            </x-form-footer>

        </div>

        <x-table-title>
            Invoice Item List
        </x-table-title>

        <x-table>
            <x-table-head>
                <th>Product</th>
                <th>Unit</th>
                <th>Sold Price</th>
                <th>Discount</th>
                <th>Quantity</th>
                <th>Is free</th>
                <th>Total</th>
                <th></th>
            </x-table-head>
            <x-table-body>
                @if ($invoice_items)

                @foreach ( $invoice_items as $key => $item )
                <tr>
                    <td> {{ $item['product_details'] }} </td>
                    <td> {{ $item['unit_details'] }} </td>
                    <td> {{ $item['unit_price'] }} </td>
                    <td> {{ $item['unit_discount'] }} </td>
                    <td> {{ $item['quantity'] }} </td>
                    <td> {{ $item['is_free'] }} </td>
                    <td> {{ $item['line_total'] }} </td>

                    <td>
                        <x-btn-delete wire:click="removeInvoiceItemFromList({{ $key }})"> X </x-btn-delete>
                    </td>
                </tr>
                @endforeach
                @endif

            </x-table-body>
        </x-table>

        <x-lable>
            <span>Sub Total</span>
            <x-text-input wire:model="total_price" />
        </x-lable>

        <x-lable>
            <span>Total Discount</span>
            <x-text-input wire:model="total_discount" />
        </x-lable>

        <x-form-footer>
            <x-flash-msg type="success" key="successInvoice" />
            <x-flash-msg type="error" key="errorInvoice" />
            <x-btn-primary wire:click.prevent='saveOrUpdateInvoice()'>
                {{ $invoice ? 'Update Invoice' : 'Save Invoice' }}
            </x-btn-primary>
        </x-form-footer>

    </x-card>
</x-page-body>
