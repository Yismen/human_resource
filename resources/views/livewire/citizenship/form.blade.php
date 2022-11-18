<div>
    @php

    $title = $editing ? join(" ", [ __('Edit'), __('Citizenship'), $citizenship->name]) : join(" ", [__('Create'),
    __('New'), __('Citizenship') ])
    @endphp

    <x-human_resource::modal modal-name="CitizenshipForm" title="{{ $title }}"
        event-name="{{ $this->modal_event_name_form }}" :backdrop="false">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">
                <x-human_resource::inputs.with-labels field="citizenship.name">{{ __('Name') }}:
                </x-human_resource::inputs.with-labels>

                <x-human_resource::inputs.text-area field="citizenship.description" :required="false">{{
                    __('Description') }}:
                </x-human_resource::inputs.text-area>
            </div>
        </x-human_resource::form>
    </x-human_resource::modal>
</div>