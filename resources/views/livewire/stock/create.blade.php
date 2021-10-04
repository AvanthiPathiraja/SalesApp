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
                <span>Batch Number</span>
                <x-text-input wire:model="number" />
                <x-form-error for="number" />
            </x-lable>

            <x-lable>
                <span>Date Recieved</span>
                <x-text-input wire:model="date" />
                <x-form-error for="date" />
            </x-lable>

            <x-lable class=" col-span-4">
                <span>Product</span>
                <x-select wire:model="product_id">
                    <option value=""></option>
                    @foreach ( $products as $product )
                    <option value="{{ $product->id }}">
                        {{ $product->product_details }}
                    </option>
                    @endforeach
                </x-select>
                <x-form-error for="product_id" />
            </x-lable>

            <x-lable>
                <span>Unit Cost</span>
                <x-text-input wire:model="unit_cost" />
                <x-form-error for="unit_cost" />
            </x-lable>

            <x-lable>
                <span>Unit Price</span>
                <x-text-input wire:model="unit_price" />
                <x-form-error for="unit_price" />
            </x-lable>

            <x-lable>
                <span>Quantity Recieved</span>
                <x-text-input wire:model="quantity" />
                <x-form-error for="quantity" />
            </x-lable>

            <x-lable>
                <span>Expire Date</span>
                <x-text-input wire:model="expire_date" />
                <x-form-error for="expire_date" />
            </x-lable>

            <x-form-footer class=" col-span-6">
                <x-flash-msg type="success" key="success" />
                <x-btn-primary wire:click='saveOrUpdateStock()'>
                    {{ $product ? 'Update' : 'Save' }}
                </x-btn-primary>
            </x-form-footer>

        </div>

    </x-card>
</x-page-body>
