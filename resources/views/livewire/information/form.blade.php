<div>
    @php

    $title = $editing ? join(" ", [ __('Edit'), __('Information'), $information->name]) : join(" ", [__('Create'),
    __('New'), __('Information') ])
    @endphp

    <x-human_resource::modal modal-name="InformationForm" title="{{ $title }}"
        event-name="{{ $this->modal_event_name_form }}" :backdrop="false">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">
                @if ($photo ?? null)
                    <div class="d">Photo Preview:</div>
                    <img src="{{ $photo->temporaryUrl() }}" height="125">
                @elseif($information && $information->photo_url)
                    <img src="{{ "/storage/".$information->photo_url }}" class="img-bordered img-circle" height="200">
                @endif
                <x-human_resource::inputs.with-labels field="photo" type="file" :required="false" class="filedrop">
                    {{ __('Image') }}:
                </x-human_resource::inputs.with-labels>

                <x-human_resource::inputs.with-labels field="information.phone">
                    {{ __('Phone') }}:
                </x-human_resource::inputs.with-labels>
                <x-human_resource::inputs.with-labels field="information.email" :required="false">
                    {{ __('Email') }}:
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