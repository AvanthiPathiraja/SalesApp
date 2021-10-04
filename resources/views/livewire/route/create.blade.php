<x-page-body>
    <x-card>

        <div class="grid grid-cols-6 gap-3 gap-x-4">

        <x-lable class=" col-span-2">
            <span>Name</span>
            <x-text-input wire:model="name" />
            <x-form-error for="name" />
        </x-lable>

        <x-lable  class=" col-span-2">
            <span>Area</span>
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
                {{ $route ? 'Update' : 'Save' }}
            </x-btn-primary>
        </x-form-footer>

        </div>

    </x-card>
</x-page-body>
