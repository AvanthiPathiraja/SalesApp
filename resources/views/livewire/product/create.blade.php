<x-slot name="header">
    <x-page-title>
        {{ $product ? 'Edit Product Info' : 'Add New Product' }}
    </x-page-title>
</x-slot>

<x-page-body>
    <x-card>

        <div class="grid grid-cols-6 gap-3 gap-x-4">

        <x-lable>
            <span>Number</span>
            <x-text-input wire:model="number" />
            <x-form-error for="number" />
        </x-lable>

        <x-lable class=" col-span-2">
            <span>Category</span>
            <x-text-input wire:model="category" />
            <x-form-error for="category" />
        </x-lable>

        <x-lable  class=" col-span-2">
            <span>Name</span>
            <x-text-input wire:model="name" />
            <x-form-error for="name" />
        </x-lable>

        <x-lable>
            <span>Unit</span>
            <x-select wire:model="unit">
                <option value=""></option>
                <option value="Packet"> Packet </option>
                <option value="Bottle"> Bottle </option>
                <option value="Box"> Box </option>
                <option value="Unit"> Unit </option>
             </x-select>
            <x-form-error for="unit" />
        </x-lable>

        <x-lable>
            <span>Metric</span>
            <x-text-input wire:model="metric" />
            <x-form-error for="metric" />
        </x-lable>

        <x-lable>
            <span>Size</span>
            <x-text-input wire:model="size" />
            <x-form-error for="size" />
        </x-lable>

        <x-lable>
            <span>Unit Price</span>
            <x-text-input wire:model="unit_price" />
            <x-form-error for="unit_price" />
        </x-lable>

        <x-lable>
            <span>Minimum Stock</span>
            <x-text-input wire:model="minimum_stock" />
            <x-form-error for="minimum_stock" />
        </x-lable>

        <x-lable class=" col-span-2">
            <span>Note</span>
            <x-text-input wire:model="note" />
            <x-form-error for="note" />
        </x-lable>

        <x-form-footer  class=" col-span-6">
            <x-flash-msg type="success" key="success" />
            <x-btn-primary wire:click='saveOrUpdateProduct()'>
                {{ $product ? 'Update' : 'Save' }}
            </x-btn-primary>
        </x-form-footer>

        </div>

    </x-card>
</x-page-body>
