<div class="w-full md:w-96 inline-block relative pr-0.5 ">
    <x-text-input type="text" placeholder="Search.." wire:model.debounce.200ms="search"
        class="leading-snug border-indigo-600  focus:bg-gray-700 focus:bg-opacity-30 block w-full bg-gray-800 focus:ring-0
            py-2 px-4 pl-10 rounded-full text-lg "/>

    <div class="pointer-events-none absolute pl-3 inset-y-0 left-0 flex items-center px-2 text-gray-400">
        <svg wire:loading.class="hidden" wire:target="search"  class="h-6 w-6 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /> </svg>

        <svg wire:loading wire:target="search"
            class="animate-spin -mt-0.5 mr-2 h-6 w-6 text-indigo-500 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path> </svg>
    </div>

</div>
