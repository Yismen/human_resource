<div>
    @php

    $title = $editing ? join(" ", [ str(__('human_resource::messages.edit'))->headline(), str(__('human_resource::messages.suspension'))->headline(), $suspension->name]) : join(" ", [str(__('human_resource::messages.create'))->headline(),
    str(__('human_resource::messages.new'))->headline(), str(__('human_resource::messages.suspension'))->headline() ])
    @endphp

    <x-human_resource::modal modal-name="SuspensionForm" title="{{ $title }}"
        event-name="{{ $this->modal_event_name_form }}" :backdrop="false">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">
                <div class="row">
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select field="suspension.employee_id" :options="$employees">{{
                            str(__('human_resource::messages.employee'))->headline() }}:
                        </x-human_resource::inputs.select>
                    </div>
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select field="suspension.suspension_type_id"
                            :options="$suspension_types">
                            {{
                            str(__('human_resource::messages.type'))->headline() }}:
                        </x-human_resource::inputs.select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <x-human_resource::inputs.with-labels field="suspension.starts_at" type="date">{{
                            __('Starts At') }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                    <div class="col-sm-6">
                        <x-human_resource::inputs.with-labels field="suspension.ends_at" type="date">{{ __('Ends At')
                            }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                </div>

                <x-human_resource::inputs.text-area field="suspension.comments" :required="false">{{
                    str(__('human_resource::messages.comments'))->headline() }}:
                </x-human_resource::inputs.text-area>
            </div>

        </x-human_resource::form>
    </x-human_resource::modal>
</div>