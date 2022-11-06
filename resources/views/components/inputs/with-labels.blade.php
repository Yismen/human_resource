@props([
'type' => 'text',
'required' => true,
'field',
])
<div class="mb-3">
    <x-human_resource::inputs.label :field="$field" :required="$required" :label="$slot" />

    <input class="form-control @error($field) is-invalid @enderror" type="{{ $type }}" id="{{ $field }}"
        aria-describedby="{{ $field }}Help" wire:model='{{ $field }}' {{ $attributes->merge([]) }}>

    <x-human_resource::inputs.error :field="$field" />
</div>