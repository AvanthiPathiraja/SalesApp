<x-page-body>
    <x-card>

        <x-table-title>
            <a href="{{ route('employee.create') }}">
                <x-btn-new>+</x-btn-new>
            </a>
            Employee List
        </x-table-title>

        <x-table>
            <x-table-head>
                <th>Number</th>
                <th>Full Name</th>
                <th>NIC</th>
                <th>Telephone</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Destination</th>
                <th></th>
                <th></th>
            </x-table-head>
            <x-table-body>
                @foreach( $employees as $employee )
                <tr>
                    <td>{{ $employee->number }}</td>
                    <td>{{ $employee->full_name }}</td>
                    <td>{{ $employee->nic_number }}</td>
                    <td>{{ $employee->telephone }}</td>
                    <td>{{ $employee->mobile }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->designation }}</td>

                    <td>
                        <a href="{{ route('employee.edit', $employee) }}">
                            <x-btn-edit>Edit</x-btn-edit>
                        </a>
                    </td>
                    <td>
                        <x-btn-delete wire:click.prevent="deleteEmployee({{ $employee }})"> X </x-btn-delete>

                    </td>
                </tr>

                @endforeach
            </x-table-body>
        </x-table>

    </x-card>
</x-page-body>
