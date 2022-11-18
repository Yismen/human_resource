<div>
    @php

    $title = $editing ? join(" ", [ __('Edit'), __('Information'), $information->name]) : join(" ", [__('Create'),
    __('New'), __('Information') ])
    @endphp

    <x-human_resource::modal modal-name="InformationForm" title="{{ $title }}"
        event-name="{{ $this->modal_event_name_form }}" :backdrop="false">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">
                <x-human_resource::inputs.with-labels field="information.phone">
                    {{ __('Phone') }}:
                </x-human_resource::inputs.with-labels>
                <x-human_resource::inputs.with-labels field="information.email" :required="false">
                    {{ __('Email') }}:
                </x-human_resource::inputs.with-labels>
                <x-human_resource::inputs.with-labels field="information.photo_url" :required="false">
                    {{ __('Image') }}:
                </x-human_resource::inputs.with-labels>
                <x-human_resource::inputs.with-labels field="information.company_id" :required="false">
                    {{ __('ID') }}:
                </x-human_resource::inputs.with-labels>
                <x-human_resource::inputs.text-area rows="2" field="information.address" :required="false">{{
                    __('Address') }}:
                </x-human_resource::inputs.text-area>
            </div>
        </x-human_resource::form>
    </x-human_resource::modal>
</div>