<x-page-body>

    <x-table-top>
        <div class=" flex space-x-2">
            <a href="{{ route('route.create') }}">
                <x-btn-new />
            </a>
            <x-table-top-title> Route List </x-table-top-title>
        </div>
        <div>
           <livewire:search-input />
        </div>
    </x-table-top>

        <x-table>
            <x-table-head>
                <th>Name</th>
                <th>Area</th>
                <th>Note</th>
                 <th></th>
            </x-table-head>

            <x-table-body>
                @foreach( $routes as $route)
                <x-tbody-tr>
                    <td>{{ $route->name }}</td>
                    <td>{{ $route->area->name }}</td>
                    <td>{{ $route->note }}</td>

                    <td>
                        <x-tbody-btn-col>
                        <a href="{{ route('route.edit', $route) }}">
                            <x-btn-edit/>
                        </a>

                        <x-btn-delete wire:click.prevent='deleteRoute({{ $route }})'/>
                    </x-tbody-btn-col>
                    </td>
                </x-tbody-tr>
                @endforeach
            </x-table-body>

        </x-table>
        {{ $routes->links() }}

</x-page-body>
