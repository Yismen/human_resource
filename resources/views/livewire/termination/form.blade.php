<div>
    @php

    $title = $editing ? join(" ", [ str(__('human_resource::messages.edit'))->headline(), str(__('human_resource::messages.termination'))->headline(), $termination->name]) : join(" ", [str(__('human_resource::messages.create'))->headline(),
    str(__('human_resource::messages.new'))->headline(), str(__('human_resource::messages.termination'))->headline() ])
    @endphp

    <x-human_resource::modal modal-name="TerminationForm" title="{{ $title }}"
        event-name="{{ $this->modal_event_name_form }}" :backdrop="false" class="modal-lg">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">

                <div class="row">
                    <div class="col-sm-4">
                        <x-human_resource::inputs.with-labels field="termination.date" type="date">{{
                            str(__('human_resource::messages.date'))->headline() }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                    <div class="col-sm-4">
                        <x-human_resource::inputs.select field="termination.termination_type_id"
                            :options="$termination_types">{{
                            str(__('human_resource::messages.type'))->headline() }}:
                        </x-human_resource::inputs.select>
                    </div>
                    <div class="col-sm-4">
                        <x-human_resource::inputs.select field="termination.termination_reason_id"
                            :options="$termination_reasons">{{
                            str(__('human_resource::messages.reason'))->headline() }}:
                        </x-human_resource::inputs.select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <x-human_resource::inputs.switch field="termination.rehireable"
                            class="{{ optional($termination)->rehireable ? 'text-success' : 'text-danger' }}">{{
                            str(__('human_resource::messages.rehireable'))->headline() }}:
                        </x-human_resource::inputs.switch>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <x-human_resource::inputs.text-area field="termination.comments">{{
                            str(__('human_resource::messages.comments'))->headline() }}:
                        </x-human_resource::inputs.text-area>
                    </div>
                </div>
            </div>

        </x-human_resource::form>
    </x-human_resource::modal>
</div>