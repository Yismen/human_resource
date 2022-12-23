<div>
    <x-human_resource::modal
        title="{{ str(__('human_resource::messages.payment_type'))->headline() }} - {{ $payment_type->name ?? '' }}"
        modal-name="PaymenTypeDetails" event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.name'))->headline() }}:</th>
                    <td class="text-left">{{ $payment_type->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.description'))->headline() }}:</th>
                    <td class="text-left">{{ $payment_type->description ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm"
                wire:click='$emit("updatePaymenType", {{ $payment_type->id ?? '' }})'>{{
                str(__('human_resource::messages.edit'))->headline() }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>