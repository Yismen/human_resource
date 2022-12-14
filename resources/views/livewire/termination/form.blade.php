<div>
    @php

    $title = $editing ? join(" ", [ __('Edit'), __('Termination'), $termination->name]) : join(" ", [__('Create'),
    __('New'), __('Termination') ])
    @endphp

    <x-human_resource::modal modal-name="TerminationForm" title="{{ $title }}"
        event-name="{{ $this->modal_event_name_form }}" :backdrop="false" class="modal-lg">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">

                <div class="row">
                    <div class="col-sm-4">
                        <x-human_resource::inputs.with-labels field="termination.date" type="date">{{
                            __('Date') }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                    <div class="col-sm-4">
                        <x-human_resource::inputs.select field="termination.termination_type_id"
                            :options="$termination_types">{{
                            __('Type') }}:
                        </x-human_resource::inputs.select>
                    </div>
                    <div class="col-sm-4">
                        <x-human_resource::inputs.select field="termination.termination_reason_id"
                            :options="$termination_reasons">{{
                            __('Reason') }}:
                        </x-human_resource::inputs.select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <x-human_resource::inputs.switch field="termination.rehireable"
                            class="{{ optional($termination)->rehireable ? 'text-success' : 'text-danger' }}">{{
                            __('Rehireable') }}:
                        </x-human_resource::inputs.switch>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <x-human_resource::inputs.text-area field="termination.comments">{{
                            __('Comments') }}:
                        </x-human_resource::inputs.text-area>
                    </div>
                </div>
            </div>

        </x-human_resource::form>
    </x-human_resource::modal>
</div>