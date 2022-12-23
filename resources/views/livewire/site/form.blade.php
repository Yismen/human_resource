<div>
    @php

    $title = $editing ? join(" ", [ str(__('human_resource::messages.edit'))->headline(), str(__('human_resource::messages.site'))->headline(), $site->name]) : join(" ", [str(__('human_resource::messages.create'))->headline(),
    str(__('human_resource::messages.new'))->headline(), str(__('human_resource::messages.site'))->headline() ])
    @endphp

    <x-human_resource::modal modal-name="SiteForm" title="{{ $title }}" event-name="{{ $this->modal_event_name_form }}"
        :backdrop="false">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">
                <x-human_resource::inputs.with-labels field="site.name">{{ str(__('human_resource::messages.name'))->headline() }}:
                </x-human_resource::inputs.with-labels>

                <x-human_resource::inputs.text-area field="site.description" :required="false">{{ str(__('human_resource::messages.description'))->headline() }}:
                </x-human_resource::inputs.text-area>
            </div>
        </x-human_resource::form>
    </x-human_resource::modal>
</div>