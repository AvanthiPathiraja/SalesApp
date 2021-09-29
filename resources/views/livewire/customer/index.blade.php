<x-slot name="header">
        <x-page-title>Customers Info </x-page-title>
    </x-slot>

    <div>
        <x-table>
            <x-table-head>
                <th>Number</th>
                <th>Name</th>
                <th>Contacted Person</th>
                <th>Telephone</th>
                <th>Mobile</th>
                <th>Route</th>
                <th>Address</th>
                <th>Email/th>
                <th>Note</th>
                <th></th>
                <th></th>
            </x-table-head>
           <x-table-body>
            @foreach( $customers as $customer)
            <x-tbody-tr>
                <td>{{ $customer->number }}</td>
                <td>{{ $customer->name  }}</td>
                <td>{{ $customer->contacted_person }}</td>
                <td>{{ $customer->telephone }}</td>
                <td>{{ $customer->mobile }}</td>
                <td>{{ $customer->route->name ?? '' }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->note }}</td>
                <td>
                    <a href="{{ route('customer.edit', $customer) }}">
                    <x-btn-edit>Edit</x-btn-edit>
                    </a>
                </td>
                <td>
                    <x-btn-delete wire:click.prevent='deleteCustomer({{ $customer }})'> X </x-btn-delete>
                </td>
            </x-tbody-tr>

        @endforeach
           </x-table-body>
        </x-table>

        {{ $customers->links() }}
    </div>



