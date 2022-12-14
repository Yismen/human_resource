<div>
    <x-human_resource::modal title="{{ __('Termination') }} - {{ $termination->name ?? '' }}"
        modal-name="TerminationDetails" event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ __('Employee') }}:</th>
                    <td class="text-left">{{ $termination->employee->full_name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Date') }}:</th>
                    <td class="text-left">{{ $termination->date ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Type') }}:</th>
                    <td class="text-left">{{ $termination->terminationType->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Reason') }}:</th>
                    <td class="text-left">{{ $termination->terminationReason->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Comments') }}:</th>
                    <td class="text-left">{{ $termination->comment ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm"
                wire:click='$emit("updateTermination", {{ $termination->id ?? '' }})'>{{
                __('Edit') }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>