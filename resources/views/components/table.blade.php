<div {{ $attributes->merge(
        ['class' => 'overflow-x-auto mx-auto w-full rounded-md shadow-md  bg-gray-700 bg-opacity-30  border border-gray-800 text-left']) }} >
    <table class="min-w-full ">
        {{ $slot }}
    </table>

</div>

