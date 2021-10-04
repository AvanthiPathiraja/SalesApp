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
        <div class="grid grid-cols-5 gap-3 gap-x-4">

            <x-lable>
                <span>Issue Note Number</span>
                <x-text-input wire:model="number" />
                <x-form-error for="number" />
            </x-lable>

            <x-lable>
                <span>Reference</span>
                <x-text-input wire:model="reference" />
                <x-form-error for="reference" />
            </x-lable>

            <x-lable>
                <span>Date Issued</span>
                <x-text-input wire:model="date" />
                <x-form-error for="date" />
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

        </div>

        <div class="grid grid-cols-5 gap-3 gap-x-4 p-2">

            <x-lable class="col-span-3">
                <span>Product details</span>
                <x-select wire:model="product_id">
                    <option value=""></option>
                    @foreach ( $products as $product )
                    <option value="{{ $product->id }}">
                        {{ "{$product->product_details}  {$product->unit_details}" }}
                    </option>
                    @endforeach
                </x-select>
                <x-form-error for="product_id" />
            </x-lable>

            <x-lable class="col-span-2">
                <span>Product Stocks</span>
                <x-select wire:model="stock_id">
                    <option value=""></option>
                    @foreach ( $stocks as $stock )
                    <option value="{{ $stock->id }}">
                        {{ "{$stock->number} - Rs. {$stock->unit_price}" }}
                    </option>
                    @endforeach
                </x-select>
                <x-form-error for="stock_id" />
            </x-lable>

            <x-lable>
                <span>Stock Expire Date</span>
                <x-text-input wire:model="expire_date" readonly />
            </x-lable>

            <x-lable>
                <span>Quantity Available</span>
                <x-text-input wire:model="available_quantity" readonly />
            </x-lable>

            <x-lable>
                <span>Quantity Issue</span>
                <x-text-input wire:model="quantity" />
                <x-form-error for="quantity" />
            </x-lable>


            <x-form-footer class="col-span-5">
                <x-flash-msg type="success" key="successIssueItem" />
                <x-flash-msg type="error" key="errorIssueItem" />
                <x-btn-primary wire:click='addIssueItemToList()'> Add </x-btn-primary>
            </x-form-footer>

        </div>

        <x-table-title>
            Issue Items List
        </x-table-title>

        <x-table>
            <x-table-head>
                <th>Stock Batch</th>
                <th>Product Details</th>
                <th>Unit Price</th>
                <th>Quantity Issued</th>
                <th>Total Value</th>
                <th></th>

            </x-table-head>
            <x-table-body>
                @if($issue_items)

                @foreach( $issue_items as $key => $issue_item )
                <tr>

                    <td>{{ $issue_item['stock_number'] }}</td>
                    <td>{{ $issue_item['product_details'] }} </td>
                    <td>{{ $issue_item['unit_price'] }} </td>
                    <td>{{ $issue_item['quantity'] }} </td>
                    <td>{{ $issue_item['line_total'] }} </td>

                    <td>
                        <x-btn-delete wire:click.prevent='removeIssueItemFromList({{ $key }})'> X
                        </x-btn-delete>
                    </td>
                </tr>

                @endforeach
                @endif
            </x-table-body>
        </x-table>

        <x-form-footer >
            <x-flash-msg type="success" key="successIssueNote" />
            <x-flash-msg type="error" key="errorIssueNote" />
            <x-btn-primary wire:click='saveOrUpdateIssueNote()'>
                {{ $issue_note ? 'Update' : 'Save' }}
            </x-btn-primary>
        </x-form-footer>

    </x-card>
</x-page-body>
