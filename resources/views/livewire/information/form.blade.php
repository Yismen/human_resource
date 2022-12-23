<div>
    @php

    $title = $editing ? join(" ", [ str(__('human_resource::messages.edit'))->headline(), str(__('human_resource::messages.information'))->headline(), $information->name]) : join(" ", [str(__('human_resource::messages.create'))->headline(),
    str(__('human_resource::messages.new'))->headline(), str(__('human_resource::messages.information'))->headline() ])
    @endphp

    <x-human_resource::modal modal-name="InformationForm" title="{{ $title }}"
        event-name="{{ $this->modal_event_name_form }}" :backdrop="false">

        <x-human_resource::form :editing="$editing">
            <div class="p-3">
                <div class="row">
                    <div class="col-sm-8">
                        <x-human_resource::inputs.with-labels field="photo" type="file" :required="false"
                            class="filedrop">
                            {{ str(__('human_resource::messages.image'))->headline() }}:
                        </x-human_resource::inputs.with-labels>
                    </div>
                    <div class="col-sm-4">
                        @if ($photo ?? null)
                        <div class="d">New Photo Preview:</div>
                        <img src="{{ $photo->temporaryUrl() }}" height="125">
                        @elseif($information && $information->photo_url)
                        <img src="{{ " /storage/".$information->photo_url }}" class="img-bordered img-circle"
                        height="200">
                        @endif
                    </div>
                </div>

                <x-human_resource::inputs.with-labels field="information.phone">
                    {{ str(__('human_resource::messages.phone'))->headline() }}:
                </x-human_resource::inputs.with-labels>
                <x-human_resource::inputs.with-labels field="information.email" :required="false">
                    {{ str(__('human_resource::messages.email'))->headline() }}:
                </x-human_resource::inputs.with-labels>
                <x-human_resource::inputs.with-labels field="information.company_id" :required="false">
                    {{ str(__('human_resource::messages.i_d'))->headline() }}:
                </x-human_resource::inputs.with-labels>
                <x-human_resource::inputs.text-area rows="2" field="information.address" :required="false">{{
                    str(__('human_resource::messages.address'))->headline() }}:
                </x-human_resource::inputs.text-area>
            </div>
        </x-human_resource::form>
    </x-human_resource::modal>

    @push('styles')
    <style>
        .filedrop:hover {
            cursor: pointer;
        }

        .dropping:hover {
            cursor: crosshair;
        }
    </style>
    @endpush
    @push('scripts')

    <script>
        class Draggable {
            constructor(element) {
                this.element = element

                this.element.addEventListener('dragenter', () => this.dragStart());
                this.element.addEventListener('dragleave', () => this.dragEnd());
                this.element.addEventListener('drope', () => this.dropped());
            }

             dragStart() {
                this.element.classList.add("dropping");
            }

             dropped() {
                this.element.classList.remove("dropping");

            }

             dragEnd() {
                this.element.classList.remove("dropping");

            }
        }

        new Draggable(document.querySelector(".filedrop"));
        
    </script>
    @endpush
</div>