<div>
    @php

    $title = $editing ? join(" ", [ str(__('human_resource::messages.edit'))->headline(), str(__('human_resource::messages.termination_reason'))->headline(), $termination_reason->name]) : join(" ",
    [str(__('human_resource::messages.create'))->headline(),
    str(__('human_resource::messages.new'))->headline(), str(__('human_resource::messages.termination_reason'))->headline() ])
    @endphp

    <x-human_resource::modal modal-name="TerminationReasonForm" title="{{ $title }}"
        event-name="{{ $this->modal_event_name_form }}" :backdrop="false">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">
                <x-human_resource::inputs.with-labels field="termination_reason.name">{{ str(__('human_resource::messages.name'))->headline() }}:
                </x-human_resource::inputs.with-labels>

                <x-human_resource::inputs.text-area field="termination_reason.description" :required="false">{{
                    str(__('human_resource::messages.description'))->headline() }}:
                </x-human_resource::inputs.text-area>
            </div>

            <x-slot name="footer">
                @if ($editing)
                <x-human_resource::button reason="submit" color="warning" class="btn-sm">
                    {{ str(__('human_resource::messages.update'))->headline() }}
                </x-human_resource::button>
                @else
                <x-human_resource::button reason="submit" color="primary" class="btn-sm">
                    {{ str(__('human_resource::messages.create'))->headline() }}
                </x-human_resource::button>
                @endif
            </x-slot>
        </x-human_resource::form>
    </x-human_resource::modal>
</div>