@props([
'field',
'required' => true,
'options',
])
<div class="mb-3">
    <x-human_resource::inputs.label :field="$field" :required="$required" :label="$slot" />

    <select class="form-control @error($field) is-invalid @enderror" wire:model='{{ $field }}' id="{{ $field }}">
        <option></option>
        @foreach ($options as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>

    <x-human_resource::inputs.error :field="$field" />
</div>