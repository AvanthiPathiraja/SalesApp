<x-page-body>

    <x-table-top>
        <div class=" flex space-x-2">
            <a href="{{ route('customer.create') }}">
                <x-btn-new/>
            </a>
            <x-table-top-title>Clients </x-table-top-title>
        </div>

        <div class=" flex space-x-2">
            <x-select wire:model="route_id" >
                <option value="">Select a route</option>
                @foreach ($routes as $route)
                    <option value="{{ $route->id }}">
                        {{ $route->name }}
                    </option>
                @endforeach
            </x-select>

            <livewire:search-input />
        </div>
    </x-table-top>

    <x-table>
        <x-table-head>
            <th>Number</th>
            <th>Name</th>
            <th>Contacted Person</th>
            <th>Telephone</th>
            <th>Mobile</th>
            <th>Route</th>
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

                <td>
                    <x-tbody-btn-col>
                        <a href="{{ route('customer.edit', $customer) }}">
                            <x-btn-edit />
                        </a>
                        <x-btn-delete wire:click.prevent='deleteCustomer({{ $customer }})' />
                    </x-tbody-btn-col>
                </td>

            </x-tbody-tr>
            @endforeach
        </x-table-body>
    </x-table>

    {{ $customers->links() }}
</x-page-body>
