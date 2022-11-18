@props([
'field',
'required' => true
])

<div class="mb-3">
    <x-human_resource::inputs.label :field="$field" :required="$required" :label="$slot" />
    <textarea wire:model='{{ $field }}' id="{{ $field }}" {{ $attributes->class([
            'form-control',
            'is-invalid' => $errors->has($field)
        ])->merge([
            'rows' => 5
        ]) }}
        ></textarea>

    <x-human_resource::inputs.error :field="$field" />
</div>