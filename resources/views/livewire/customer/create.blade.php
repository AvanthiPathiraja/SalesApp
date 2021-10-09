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

        <div class="grid grid-cols-6 gap-3 gap-x-4">

            <x-lable>
                <span>Number *</span>
                <x-text-input wire:model="number" />
                <x-form-error for="number" />
            </x-lable>

            <x-lable class="col-span-3">
                <span>Name *</span>
                <x-text-input wire:model="name" />
                <x-form-error for="name" />
            </x-lable>

            <x-lable class="col-span-2">
                <span>Contacted Person *</span>
                <x-text-input wire:model="contacted_person" />
                <x-form-error for="contacted_person" />
            </x-lable>

            <x-lable>
                <span>Telephone *</span>
                <x-text-input wire:model="telephone" />
                <x-form-error for="telephone" />
            </x-lable>

            <x-lable>
                <span>Mobile</span>
                <x-text-input wire:model="mobile" />
                <x-form-error for="mobile" />
            </x-lable>

            <x-lable class="col-span-2">
                <span>Email</span>
                <x-email-input wire:model="email" />
                <x-form-error for="email" />
            </x-lable>

            <x-lable class="col-span-2">
                <span>Route *</span>
                <x-select wire:model='route_id'>
                    <option value=""></option>
                    @foreach ( $routes as $route )
                    <option value="{{ $route->id }}">
                        {{ $route->name }}
                    </option>
                    @endforeach
                </x-select>
                <x-form-error for="route_id" />
            </x-lable>

            <x-lable class="col-span-4">
                <span>Address *</span>
                <x-text-input wire:model="address" />
                <x-form-error for="address" />
            </x-lable>


            <x-lable class="col-span-2">
                <span>Note</span>
                <x-text-input wire:model="note" />
                <x-form-error for="note" />
            </x-lable>

            <x-form-footer class="col-span-6">
                <x-flash-msg type="success" key="success" />
                <x-btn-primary wire:click.prev='saveOrUpdateCustomer()'>
                    {{ $customer ? 'Update' : 'Save' }}
                </x-btn-primary>

            </x-form-footer>
        </div>
    </x-card>
</x-page-body>
