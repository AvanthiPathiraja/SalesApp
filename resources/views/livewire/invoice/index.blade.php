<x-page-body>

            <x-table-top >
                <div class=" flex space-x-2">
                <a href="{{ route('invoice.create') }}">
                    <x-btn-new/>
                </a>
                <x-table-top-title> Invoice List </x-table-top-title>
            </div>
            <div>
                <livewire:search-input/>

            </div>
            </x-table-top>

            <x-table>
                    <x-table-head>
                        <th>Invoice Number</th>
                        <th>Reference</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Distributor</th>
                        <th>Total Price</th>
                        <th>Total Discounts</th>
                        <th></th>
                    </x-table-head>

                  <x-table-body>
                    @foreach( $invoices as $invoice )
                    <x-tbody-tr>
                        <td>{{ $invoice->number }}</td>
                        <td>{{ $invoice->reference }}</td>
                        <td>{{ $invoice->date }}</td>
                        <td>{{ $invoice->customer->name }}</td>
                        <td>{{ $invoice->distributor->full_name }}</td>
                        <td>{{ $invoice->total_price }}</td>
                        <td>{{ number_format($invoice->total_discount) }}</td>

                        <td>
                            <x-tbody-btn-col>
                            <a href="{{ route('invoice.edit', $invoice) }}">
                                <x-btn-edit/>
                            </a>
                            <x-btn-delete wire:click.prevent="deleteInvoice({{ $invoice }})"/>
                        </x-tbody-btn-col>
                        </td>
                    </x-tbody-tr>

                @endforeach
            </x-table-body>
                </x-table>
{{ $invoices->links() }}
        </x-page-body>
