<div>
    @php

    $title = $editing ? join(" ", [ __('Edit'), __('Termination'), $termination->name]) : join(" ", [__('Create'),
    __('New'), __('Termination') ])
    @endphp

    <x-human_resource::modal modal-name="TerminationForm" title="{{ $title }}"
        event-name="{{ $this->modal_event_name_form }}" :backdrop="false">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">
                <x-human_resource::inputs.with-labels field="termination.name">{{ __('Name') }}:
                </x-human_resource::inputs.with-labels>

                <x-human_resource::inputs.text-area field="termination.description" :required="false">{{
                    __('Description') }}:
                </x-human_resource::inputs.text-area>
            </div>
        </x-human_resource::form>
    </x-human_resource::modal>
</div>