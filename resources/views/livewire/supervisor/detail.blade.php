<div>
    <livewire:human_resource::information.form />

    <x-human_resource::modal title="{{ str(__('human_resource::messages.supervisor'))->headline() }} - {{ $supervisor->name ?? '' }}"
        modal-name="SupervisorDetails" event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.name'))->headline() }}:</th>
                    <td class="text-left">{{ $supervisor->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.description'))->headline() }}:</th>
                    <td class="text-left">{{ $supervisor->description ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-human_resource::information.detail :information="$supervisor->information ?? ''"
            :model-name="optional($supervisor)->getMorphClass()" :model-id="$supervisor->id ?? ''" />

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm"
                wire:click='$emit("updateSupervisor", {{ $supervisor->id ?? '' }})'>{{
                str(__('human_resource::messages.edit'))->headline() }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>