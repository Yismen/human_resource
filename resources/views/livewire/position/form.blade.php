<div>
    @php

    $title = $editing ? join(" ", [ __('Edit'), __('Position'), $position->name]) : join(" ", [__('Create'),
    __('New'), __('Position') ])
    @endphp

    <x-human_resource::modal modal-name="PositionForm" title="{{ $title }}"
        event-name="{{ $this->modal_event_name_form }}" :backdrop="false" class="modal-lg">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">
                <div class="row">
                    <div class="col-sm-6">
                        <x-human_resource::inputs.with-labels field="position.name">{{ __('Name') }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select field="position.department_id" :options="$departments_list">{{
                            __('Department') }}:
                        </x-human_resource::inputs.select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select field="position.payment_type_id"
                            :options="$payment_types_list">{{
                            __('Payment Type') }}:
                        </x-human_resource::inputs.select>
                    </div>
                    <div class="col-sm-6">
                        <x-human_resource::inputs.with-labels field="position.salary" type="number" min="0" max="400000"
                            step="0.01">{{ __('Salary') }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                </div>

                <x-human_resource::inputs.text-area field="position.description" :required="false">{{ __('Description')
                    }}:
                </x-human_resource::inputs.text-area>
            </div>
        </x-human_resource::form>
    </x-human_resource::modal>
</div>