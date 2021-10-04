<x-page-body>
    <x-card>

        <x-table-top>
            <div class=" flex space-x-2">
                <a href="{{ route('employee.index') }}">
                    <x-btn-back/>
                </a>
                <x-table-top-title>Employee Info </x-table-top-title>
            </div>
        </x-table-top>

        <div class="grid grid-cols-6 gap-3 gap-x-4">

            <x-lable>
                <span>Number</span>
                <x-text-input wire:model="number" />
                <x-form-error for="number" />
            </x-lable>

            <x-lable>
                <span>Title</span>
                <x-select wire:model="title">
                    <option></option>
                    <option value="Mr."> Mr.</option>
                    <option value="Ms."> Ms.</option>
                    <option value="Mrs."> Mrs.</option>
                </x-select>
                <x-form-error for="title" />
            </x-lable>

            <x-lable class="col-span-2">
                <span>First name</span>
                <x-text-input wire:model="first_name" />
                <x-form-error for="first_name" />
            </x-lable>

            <x-lable class="col-span-2">
                <span>Last name</span>
                <x-text-input wire:model="last_name" />
                <x-form-error for="last_name" />
            </x-lable>

            <x-lable>
                <span>Date of birth</span>
                <x-text-input wire:model="date_of_birth" />
                <x-form-error for="date_of_birth" />
            </x-lable>

            <x-lable>
                <span>NIC number</span>
                <x-text-input wire:model="nic_number" />
                <x-form-error for="nic_number" />
            </x-lable>

            <x-lable class="col-span-2">
                <span>Driving license number</span>
                <x-text-input wire:model="driving_lisence_number" />
                <x-form-error for="driving_lisence_number" />
            </x-lable>

            <x-lable>
                <span>Telephone</span>
                <x-text-input wire:model="telephone" />
                <x-form-error for="telephone" />
            </x-lable>

            <x-lable>
                <span>Mobile</span>
                <x-text-input wire:model="mobile" />
                <x-form-error for="mobile" />
            </x-lable>

            <x-lable class="col-span-4">
                <span>Address</span>
                <x-text-input wire:model="address" />
                <x-form-error for="address" />
            </x-lable>

            <x-lable class="col-span-2">
                <span>Email</span>
                <x-email-input wire:model="email" />
                <x-form-error for="email" />
            </x-lable>

            <x-lable class="col-span-2">
                <span>Designation</span>
                <x-select wire:model="designation">
                    <option></option>
                    <option value="Distributor"> Distributor</option>
                    <option value="Ref"> Ref</option>
                    <option value="Executive"> Executive</option>
                </x-select>
                <x-form-error for="designation" />
            </x-lable>

            <x-form-footer class="col-span-6">
                <x-flash-msg type="success" key="success" />
                <x-btn-primary wire:click='saveOrUpdateEmployee()'>
                    {{ $employee ? 'Update' : 'Save' }}
                </x-btn-primary>
            </x-form-footer>

        </div>
    </x-card>
</x-page-body>
