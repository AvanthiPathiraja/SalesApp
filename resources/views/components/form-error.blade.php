<div {{ $attributes->merge(['class' => 'text-sm text-red-500 mt-0.5']) }}>
    @error($for)
        {{ $message ?? ''}}
    @enderror
</div>
