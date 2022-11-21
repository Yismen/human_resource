<div>
    @php

    $title = $editing ? join(" ", [ __('Edit'), __('Employee'), $employee->full_name]) : join(" ", [__('Create'),
    __('New'), __('Employee') ])
    @endphp


    <x-human_resource::modal modal-name="EmployeeForm" title="{{ $title }}"
    event-name="{{ $this->modal_event_name_form }}" :backdrop="false" class="modal-lg">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">
                <div class="row">
                    <div class="col-sm-6">
                        <x-human_resource::inputs.with-labels field="employee.first_name">
                            {{ __('First Name') }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                    <div class="col-sm-6">
                        <x-human_resource::inputs.with-labels field="employee.second_first_name" :required="false">{{
                            __('Second First
                            Name') }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <x-human_resource::inputs.with-labels field="employee.last_name">
                            {{ __('Last Name') }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                    <div class="col-sm-6">
                        <x-human_resource::inputs.with-labels field="employee.second_last_name" :required="false">
                            {{
                            __('Second Last
                            Name') }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <x-human_resource::inputs.with-labels field="employee.personal_id">
                            {{ __('Personal Id') }} {{ __('Or') }} {{ __('Passport') }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                    <div class="col-sm-4">
                        <x-human_resource::inputs.with-labels field="employee.hired_at" type="date">{{
                            __('Hire Date') }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <x-human_resource::inputs.with-labels field="employee.date_of_birth" type="date">
                            {{ __('Date Of Birth') }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                    <div class="col-sm-6">
                        <x-human_resource::inputs.with-labels field="employee.cellphone">{{
                            __('Cellphone') }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select field="employee.gender" :options="$genders">{{
                            __('Gender') }}:
                        </x-human_resource::inputs.select>
                    </div>
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select field="employee.marriage" :options="$maritals">{{
                            __('Marital Status') }}:
                        </x-human_resource::inputs.select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <x-human_resource::inputs.switch field="employee.kids">{{
                            __('Has Kids') }}?:
                        </x-human_resource::inputs.switch>
                    </div>
                    {{-- <div class="col-sm-6">
                        <x-human_resource::inputs.with-labels field="employee.status" disabled="disabled">
                            {{ __('Status') }}:
                        </x-human_resource::inputs.with-labels>
                    </div> --}}
                </div>
            </div>
        </x-human_resource::form>
    </x-human_resource::modal>
</div>