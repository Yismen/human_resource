@props([
'field',
'required' => true
])
<div class="mb-3">
    <x-human_resource::inputs.label :field="$field" :required="$required" :label="$slot" />

    <textarea rows="5" class="form-control @error($field) is-invalid @enderror" wire:model='{{ $field }}'
        id="{{ $field }}"></textarea>

    <x-human_resource::inputs.error :field="$field" />
</div>