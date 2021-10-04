<div class="md:flex flex-col md:flex-row md:min-h-screen w-64 fixed left-0 top-0 bottom-0">
    <div @click.away="open = false"
      class="flex flex-col w-full md:w-64 text-gray-200 bg-gray-900 dark-mode:text-gray-200 dark-mode:bg-gray-800 flex-shrink-0"
      x-data="{ open: false }">
      <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
        <a href="{{ route('dashboard') }}"
          class="text-lg font-semibold tracking-widest text-white uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">Sales App</a>
        <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
          <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
            <path x-show="!open" fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
              clip-rule="evenodd"></path>
            <path x-show="open" fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
      <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">

        <x-layout.sidebar-link path="{{ route('customer.index') }}" name="Customers" />
        <x-layout.sidebar-link path="{{ route('route.index') }}" name="Route List" />
        <x-layout.sidebar-link path="{{ route('employee.index') }}" name="Employees" />
        <x-layout.sidebar-link path="{{ route('product.index') }}" name="Product List" />
        <x-layout.sidebar-link path="{{ route('stock.index') }}" name="Main Stock" />
        <x-layout.sidebar-link path="{{ route('issue-note.index') }}" name="Stock Issue Notes" />
        <x-layout.sidebar-link path="{{ route('invoice.index') }}" name="invoices" />
        <x-layout.sidebar-link path="{{ route('invoice-payment.index') }}" name="Customer Payments" />
        <x-layout.sidebar-link path="{{ route('invoice-return.index') }}" name="Customer Returns" />
        <x-layout.sidebar-link path="{{ route('issue-return.index') }}" name="Distributor Returns" />
        <x-layout.sidebar-link path="{{ route('discarded-stock.index') }}" name="Discarded Stock" />


        {{-- <x-layout.dropdown name="Dropdown">

          <x-layout.dropdown-link path="#" name="Link 1" />
          <x-layout.dropdown-link path="#" name="Link 2" />
          <x-layout.dropdown-link path="#" name="Link 3" />
        </x-layout.dropdown> --}}

      </nav>
    </div>
  </div>
