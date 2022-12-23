<div>
    <x-human_resource::modal title="{{ str(__('human_resource::messages.citizenship'))->headline() }} - {{ $citizenship->name ?? '' }}"
        modal-name="CitizenshipDetails" event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.name'))->headline() }}:</th>
                    <td class="text-left">{{ $citizenship->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.description'))->headline() }}:</th>
                    <td class="text-left">{{ $citizenship->description ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm"
                wire:click='$emit("updateCitizenship", {{ $citizenship->id ?? '' }})'>{{
                str(__('human_resource::messages.edit'))->headline() }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>