<x-page-body>
    <x-card>
        <x-table-title>
            <a href="{{ route('product.create') }}">
                <x-btn-new>+</x-btn-new>
            </a>
            Products List
        </x-table-title>

        <x-table>
            <x-table-head>
                <th>Number</th>
                <th>Category</th>
                <th>Name</th>
                <th>Unit</th>
                <th>Metric</th>
                <th>Size</th>
                <th>Minimum Stock</th>
                <th>Unit Price</th>
                <th>Note</th>
                <th></th>
                <th></th>
            </x-table-head>
            <x-table-body>
                @foreach( $products as $product)
                <tr>
                    <td>{{ $product->number }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->unit }}</td>
                    <td>{{ $product->metric }}</td>
                    <td>{{ $product->size }}</td>
                    <td>{{ $product->minimum_stock }}</td>
                    <td>{{ $product->unit_price }}</td>
                    <td>{{ $product->note }}</td>
                    <td>
                        <a href="{{ route('product.edit', $product) }}">
                            <x-btn-edit>Edit</x-btn-edit>
                        </a>
                    </td>
                    <td>
                        <x-btn-delete wire:click.prevent='deleteProduct({{ $product }})'> X </x-btn-delete>
                    </td>
                </tr>
                @endforeach
            </x-table-body>

        </x-table>

        //-pagination tags
        <div class="py-2">
            <nav class="block">
                <ul class="flex pl-0 rounded list-none flex-wrap">
                    <li>
                        <a href="#pablo"
                            class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid border-pink-500 bg-gray-800 text-pink-400">
                            1
                        </a>
                    </li>
                    <li>
                        <a href="#pablo"
                            class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid border-pink-500 bg-gray-800 text-pink-400">
                            1
                        </a>
                    </li>
                    <li>
                        <a href="#pablo"
                            class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid border-pink-500 bg-gray-800 text-pink-400">
                            1
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </x-card>
</x-page-body>
