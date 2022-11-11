<div>
    @php

    $title = $editing ? join(" ", [ __('Edit'), __('Ars'), $ars->name]) : join(" ", [__('Create'),
    __('New'), __('Ars') ])
    @endphp

    <x-human_resource::modal modal-name="ArsForm" title="{{ $title }}" event-name="{{ $this->modal_event_name_form }}"
        :backdrop="false">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">
                <x-human_resource::inputs.with-labels field="ars.name">Name:</x-human_resource::inputs.with-labels>

                <x-human_resource::inputs.text-area field="ars.description" :required="false">{{ __('Description') }}:
                </x-human_resource::inputs.text-area>
            </div>

            <x-slot name="footer">
                @if ($editing)
                <x-human_resource::button type="submit" color="warning" class="btn-sm">
                    {{ __('Update') }}
                </x-human_resource::button>
                @else
                <x-human_resource::button type="submit" color="primary" class="btn-sm">
                    {{ __('Create') }}
                </x-human_resource::button>
                @endif
            </x-slot>
        </x-human_resource::form>
    </x-human_resource::modal>
</div>