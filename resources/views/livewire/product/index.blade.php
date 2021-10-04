<x-page-body>

    <x-table-top>
        <div class=" flex space-x-2">
            <a href="{{ route('product.create') }}">
                <x-btn-new />
            </a>
            <x-table-top-title> Product List </x-table-top-title>
        </div>
        <div class=" flex space-x-2">
            <x-select wire:model="category" >
                <option value=""> Select a category </option>
                @foreach ($categories as $category)
                    <option value="">
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-select>

            <livewire:search-input />
        </div>
    </x-table-top>

        <x-table>
            <x-table-head>
                <th>Number</th>
                <th>Category</th>
                <th>Name</th>
                 <th>Metric</th>
                <th>Size</th>
                <th>Unit Price</th>
                <th></th>
            </x-table-head>

            <x-table-body>
                @foreach( $products as $product)
                <x-tbody-tr>
                    <td>{{ $product->number }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->metric }}</td>
                    <td>{{ $product->size }}</td>
                    <td>{{ number_format($product->unit_price,2) }}</td>
                    <td>
                        <x-tbody-btn-col>
                        <a href="{{ route('product.edit', $product) }}">
                            <x-btn-edit/>
                        </a>

                        <x-btn-delete wire:click.prevent='deleteProduct({{ $product }})'/>
                    </x-tbody-btn-col>
                    </td>
                </x-tbody-tr>
                @endforeach
            </x-table-body>

        </x-table>
        {{ $products->links() }}

</x-page-body>
