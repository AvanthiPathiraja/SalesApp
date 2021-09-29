@php
    if ($type == 'error') {
        $typeClass = ' border-red-800 bg-red-500 bg-opacity-60 px-4 py-1 text-red-100';
    }
    if ($type == 'success') {
        $typeClass = ' border-green-800 bg-green-600 bg-opacity-60 px-4 py-1 text-green-100';
    }
@endphp

@if(session()->has($key))
    <div {{ $attributes->merge(['class' => 'flex gap-2 border rounded-full text-sm font-bold items-center'.$typeClass]) }}>

        @if ($type == 'success')
        <svg xmlns="http://www.w3.org/2000/svg" class=" w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /> </svg>

        @endif

        @if ($type == 'error')

        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
        </svg>
        @endif
        {{ session()->get($key) }}
    </div>
@endif
