<div>
    <x-human_resource::modal title="{{ str(__('human_resource::messages.termination_type'))->headline() }} - {{ $termination_type->name ?? '' }}"
        modal-name="TerminationTypeDetails" event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.name'))->headline() }}:</th>
                    <td class="text-left">{{ $termination_type->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.description'))->headline() }}:</th>
                    <td class="text-left">{{ $termination_type->description ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm"
                wire:click='$emit("updateTerminationType", {{ $termination_type->id ?? '' }})'>{{
                str(__('human_resource::messages.edit'))->headline() }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>