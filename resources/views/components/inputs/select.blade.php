@props([
'field',
'required' => true,
'options',
])
<div class="mb-3">
    <x-human_resource::inputs.label :field="$field" :required="$required" :label="$slot" />

    <select @if ($attributes->has("multiple"))
        wire:model.debounce.500ms='{{ $field }}'
        @else
        wire:model='{{ $field }}'
        @endif
        id="{{ $field }}"
        {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($field)
        ])->merge([
        ]) }}
        >
        <option></option>
        @foreach ($options as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>

    <x-human_resource::inputs.error :field="$field" />
</div>