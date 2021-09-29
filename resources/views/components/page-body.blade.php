<div {{ $attributes->merge(['class'=>'bg-gray-800']) }}>
    <div {{ $attributes->merge(['class'=>'max-w-7xl mx-auto sm:px-6 lg:px-8']) }}>
        {{ $slot }}
    </div>
</div>

