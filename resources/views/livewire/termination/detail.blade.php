<div>
    <x-human_resource::modal title="{{ str(__('human_resource::messages.termination'))->headline() }} - {{ $termination->name ?? '' }}"
        modal-name="TerminationDetails" event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.employee'))->headline() }}:</th>
                    <td class="text-left">{{ $termination->employee->full_name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.date'))->headline() }}:</th>
                    <td class="text-left">{{ $termination->date ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.type'))->headline() }}:</th>
                    <td class="text-left">{{ $termination->terminationType->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.reason'))->headline() }}:</th>
                    <td class="text-left">{{ $termination->terminationReason->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.comments'))->headline() }}:</th>
                    <td class="text-left">{{ $termination->comment ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm"
                wire:click='$emit("updateTermination", {{ $termination->id ?? '' }})'>{{
                str(__('human_resource::messages.edit'))->headline() }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>