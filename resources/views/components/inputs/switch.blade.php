@props([
'field',
'required' => true,
'options',
])
<div class="mb-3">
    {{--
    <x-human_resource::inputs.label :field="$field" :required="$required" :label="$slot" /> --}}

    <div class="form-check form-check-inline">
        <label class="form-check-label @error($field) is-invalid @enderror">
            <input class=" form-check-input" type="checkbox" wire:model='{{ $field }}'> {{ $slot }}
        </label>
        <x-human_resource::inputs.error :field="$field" />
    </div>

</div>