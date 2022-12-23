<div>
    <livewire:human_resource::information.form />

    <x-human_resource::modal title="{{ str(__('human_resource::messages.bank'))->headline() }} - {{ $bank->name ?? '' }}" modal-name="BankDetails"
        event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.name'))->headline() }}:</th>
                    <td class="text-left">{{ $bank->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.description'))->headline() }}:</th>
                    <td class="text-left">{{ $bank->description ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-human_resource::information.detail :information="$bank->information ?? ''"
            :model-name="optional($bank)->getMorphClass()" :model-id="$bank->id ?? ''" />

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm" wire:click='$emit("updateBank", {{ $bank->id ?? '' }})'>{{
                str(__('human_resource::messages.edit'))->headline() }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>