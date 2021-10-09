<x-page-body>
    <x-card>

        <x-table-top>
            <div class=" flex space-x-2">
                <a href="{{ route('discarded-stock.index') }}">
                    <x-btn-back/>
                </a>
                <x-table-top-title>Discarded stock Info </x-table-top-title>
            </div>
        </x-table-top>
            <div class="grid grid-cols-6 gap-3 gap-x-4">

             <x-lable>
                <span>Discarded Date</span>
                <x-text-input wire:model="date" />
                <x-form-error for="date" />
            </x-lable>

             <x-lable class=" col-span-3">
                <span>Product </span>
                <x-select wire:model="stock_id">
                    <option value=""></option>
                    @foreach($stocks as $stock )
                        <option value="{{ $stock->id }}">
                            {{ "{$stock->number} - {$stock->product->product_details}" }}
                        </option>
                    @endforeach
                </x-select>
                <x-form-error for="stock_id" />
            </x-lable>

            <x-lable>
                <span>Current Quantity</span>
                <x-text-input wire:model="current_stock_quantity" readonly />
            </x-lable>

            <x-lable>
                <span>Discarded Quantity</span>
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

            <x-lable class=" col-span-2">
                <span>Collected employee</span>
                <x-select wire:model="employee_id">
                    <option value=""></option>
                    @foreach ( $employees as $employee )
                    <option value="{{ $employee->id }}">
                        {{ "{$employee->number} - {$employee->full_name}" }}
                    </option>
                    @endforeach
                </x-select>
                <x-form-error for="employee_id" />
            </x-lable>

            <x-lable class=" col-span-2">
                <span>Note </span>
                <x-text-input wire:model="note" />
                <x-form-error for='note' />
            </x-lable>

            <x-form-footer class="col-span-6">
                <x-flash-msg type="success" key="success" />
                <x-flash-msg type="error" key="invalidQuantity" />
                <x-btn-primary wire:click.prevent='saveDiscardedStock()'>
                    Save
                </x-btn-primary>
            </x-form-footer>

        </div>

    </x-card>
</x-page-body>
