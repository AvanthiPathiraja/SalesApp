<x-page-body>

        <x-table-top>
            <div class=" flex space-x-2">
                <a href="{{ route('employee.create') }}">
                    <x-btn-new />
                </a>
                <x-table-top-title> Employees </x-table-top-title>
            </div>
            <div>
                <livewire:search-input />
            </div>
        </x-table-top>

        <x-table>
            <x-table-head>
                <th>Number</th>
                <th>Full Name</th>
                <th>NIC</th>
                <th>Telephone</th>
                <th>Mobile</th>
                <th>Destination</th>
                <th></th>
            </x-table-head>

            <x-table-body>
                @foreach( $employees as $employee )
                <x-tbody-tr>
                    <td>{{ $employee->number }}</td>
                    <td>{{ $employee->full_name }}</td>
                    <td>{{ $employee->nic_number }}</td>
                    <td>{{ $employee->telephone }}</td>
                    <td>{{ $employee->mobile }}</td>
                    <td>{{ $employee->designation }}</td>

                    <td>
                    <x-tbody-btn-col>
                        <a href="{{ route('employee.edit', $employee) }}">
                            <x-btn-edit />
                        </a>

                        <x-btn-delete wire:click.prevent="deleteEmployee({{ $employee }})" />
                    </x-tbody-btn-col>
                    </td>
                </x-tbody-tr>

                @endforeach
            </x-table-body>
        </x-table>
        {{ $employees->links() }}

</x-page-body>
