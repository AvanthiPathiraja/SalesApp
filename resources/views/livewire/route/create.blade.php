<x-page-body>
    <x-card>

        <x-table-top>
            <div class=" flex space-x-2">
                <a href="{{ route('route.index') }}">
                    <x-btn-back/>
                </a>
                <x-table-top-title>Route Info </x-table-top-title>
            </div>
        </x-table-top>

        <div class="grid grid-cols-6 gap-3 gap-x-4">

        <x-lable class=" col-span-2">
            <span>Name *</span>
            <x-text-input wire:model="name" />
            <x-form-error for="name" />
        </x-lable>

        <x-lable  class=" col-span-2">
            <span>Area *</span>
            <x-text-input wire:model="area_id" />
            <x-form-error for="area_id" />
        </x-lable>

       <x-lable class=" col-span-2">
            <span>Note</span>
            <x-text-input wire:model="note" />
            <x-form-error for="note" />
        </x-lable>

        <x-form-footer  class=" col-span-6">
            <x-flash-msg type="success" key="success" />
            <x-btn-primary wire:click='saveOrUpdateRoute()'>
                {{ $distributor_route ? 'Update' : 'Save' }}
            </x-btn-primary>
            @if ($distributor_route)
            <x-btn-reset wire:click="resetRoute()"> Reset </x-btn-reset>
        @endif
        </x-form-footer>

        </div>

    </x-card>
</x-page-body>
