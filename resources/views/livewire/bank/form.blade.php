<div>
    @php

    $title = $editing ? join(" ", [ __('Edit'), __('Bank'), $bank->name]) : join(" ", [__('Create'),
    __('New'), __('Bank') ])
    @endphp

    <x-human_resource::modal modal-name="BankForm" title="{{ $title }}" event-name="{{ $this->modal_event_name_form }}"
        :backdrop="false">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">
                <x-human_resource::inputs.with-labels field="bank.name">{{ __('Name') }}:
                </x-human_resource::inputs.with-labels>

                <x-human_resource::inputs.text-area field="bank.description" :required="false">{{ __('Description') }}:
                </x-human_resource::inputs.text-area>
            </div>
        </x-human_resource::form>
    </x-human_resource::modal>
</div>