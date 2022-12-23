<div>
    @php
    $title = $editing ? join(" ", [ str(__('human_resource::messages.edit'))->headline(), str(__('human_resource::messages.employee'))->headline(), $employee->full_name]) : join(" ", [str(__('human_resource::messages.create'))->headline(),
    str(__('human_resource::messages.new'))->headline(), str(__('human_resource::messages.employee'))->headline() ])
    @endphp


    <x-human_resource::modal modal-name="EmployeeForm" title="{{ $title }}" title-class="{{ $titleClass }}"
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
                            {{ __('Personal Id') }} {{ str(__('human_resource::messages.or'))->headline() }} {{ str(__('human_resource::messages.passport'))->headline() }}:
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
                            str(__('human_resource::messages.cellphone'))->headline() }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select field="employee.site_id" :options="$sites">{{
                            str(__('human_resource::messages.site'))->headline() }}:
                        </x-human_resource::inputs.select>
                    </div>
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select field="employee.project_id" :options="$projects">{{
                            str(__('human_resource::messages.project'))->headline() }}:
                        </x-human_resource::inputs.select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select field="employee.position_id" :options="$positions">{{
                            str(__('human_resource::messages.position'))->headline() }}:
                        </x-human_resource::inputs.select>
                    </div>
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select field="employee.citizenship_id" :options="$citizenships">{{
                            str(__('human_resource::messages.citizenship'))->headline() }}:
                        </x-human_resource::inputs.select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select field="employee.gender" :options="$genders">{{
                            str(__('human_resource::messages.gender'))->headline() }}:
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
                        <x-human_resource::inputs.select :required="false" field="employee.supervisor_id" :options="$supervisors">{{
                            str(__('human_resource::messages.supervisor'))->headline() }}:
                        </x-human_resource::inputs.select>
                    </div>
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select :required="false" field="employee.afp_id" :options="$afps">{{
                            str(__('human_resource::messages.afp'))->headline() }}:
                        </x-human_resource::inputs.select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <x-human_resource::inputs.select :required="false" field="employee.ars_id" :options="$arss">{{
                            str(__('human_resource::messages.ars'))->headline() }}:
                        </x-human_resource::inputs.select>
                    </div>
                    <div class="col-sm-6">
                        <x-human_resource::inputs.switch :required="false" field="employee.kids">{{
                            __('Has Kids') }}?:
                        </x-human_resource::inputs.switch>
                    </div>
                </div>
            </div>
        </x-human_resource::form>

        @if ($editing)
            <div class="border-top d-flex justify-content-end flex-column p-2" style="gap: 3px;">
                @switch($employee->status ?? '')
                    @case(\Dainsys\HumanResource\Support\Enums\EmployeeStatus::CURRENT)
                        <livewire:human_resource::employee.terminate :employee="$employee" />
                        <livewire:human_resource::employee.suspend :employee="$employee" />
                        
                        @break
                    @case(\Dainsys\HumanResource\Support\Enums\EmployeeStatus::INACTIVE)
                        <livewire:human_resource::employee.reactivate :employee="$employee" />
                        
                        @break                    
                    @case(\Dainsys\HumanResource\Support\Enums\EmployeeStatus::SUSPENDED)
                        <livewire:human_resource::employee.terminate :employee="$employee" />
                        <livewire:human_resource::employee.suspend :employee="$employee" />
                    
                        @break
                    @default
                        
                @endswitch
            </div>
        @endif
    </x-human_resource::modal>
</div>