<div>
    @php

    $title = $editing ? join(" ", [ __('Edit'), __('Suspension'), $suspension->name]) : join(" ", [__('Create'),
    __('New'), __('Suspension') ])
    @endphp

    <x-human_resource::modal modal-name="SuspensionForm" title="{{ $title }}"
        event-name="{{ $this->modal_event_name_form }}" :backdrop="false">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">
                <div class="row">
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select field="suspension.employee_id" :options="$employees">{{
                            __('Employee') }}:
                        </x-human_resource::inputs.select>
                    </div>
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select field="suspension.suspension_type_id"
                            :options="$suspension_types">
                            {{
                            __('Type') }}:
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
                    __('Comments') }}:
                </x-human_resource::inputs.text-area>
            </div>

        </x-human_resource::form>
    </x-human_resource::modal>
</div>