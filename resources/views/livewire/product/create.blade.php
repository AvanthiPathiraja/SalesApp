<x-page-body>
    <x-card>

        <x-table-top>
            <div class=" flex space-x-2">
                <a href="{{ route('product.index') }}">
                    <x-btn-back/>
                </a>
                <x-table-top-title>Product Info </x-table-top-title>
            </div>
        </x-table-top>
        <div class="grid grid-cols-6 gap-3 gap-x-4">

        <x-lable>
            <span>Number *</span>
            <x-text-input wire:model="number" />
            <x-form-error for="number" />
        </x-lable>

        <x-lable class=" col-span-2">
            <span>Category *</span>
            <x-text-input wire:model="category" />
            <x-form-error for="category" />
        </x-lable>

        <x-lable  class=" col-span-3">
            <span>Name *</span>
            <x-text-input wire:model="name" />
            <x-form-error for="name" />
        </x-lable>

        <x-lable>
            <span>Metric *</span>
            <x-text-input wire:model="metric" />
            <x-form-error for="metric" />
        </x-lable>

        <x-lable>
            <span>Size *</span>
            <x-text-input wire:model="size" />
            <x-form-error for="size" />
        </x-lable>

        <x-lable>
            <span>Unit Price *</span>
            <x-text-input wire:model="unit_price" />
            <x-form-error for="unit_price" />
        </x-lable>

        <x-lable>
            <span>Minimum Stock *</span>
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
            @if ($product)
                <x-btn-reset wire:click="resetProduct()"> Reset </x-btn-reset>
            @endif
        </x-form-footer>

        </div>

    </x-card>
</x-page-body>
