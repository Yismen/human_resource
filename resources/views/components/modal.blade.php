@props([
'modalName',
'title',
'footer',
'eventName',
'backdrop' => true
])
<div>
    <!-- Modal -->
    <div class="modal fade" @if ((bool)$backdrop==false) data-backdrop="static" data-keyboard="false" @endif
        id="{{ $modalName }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
        wire:ignore.self>
        <div {{ $attributes->merge([
            'class' => "modal-dialog modal-dialog-centered modal-dialog-scrollable"
            ]) }} role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    {{ $slot }}
                </div>
                @isset($footer)
                <div class="modal-footer">
                    {{ $footer }}
                </div>
                @endisset
            </div>
        </div>
    </div>

</div>
@push('scripts')
<script>
    document.addEventListener('{{ $eventName }}', (event) => {
        let element = $('#' + '{{ $modalName }}');
        element.modal('show');
    })
    document.addEventListener('closeAllModals', (event) => {
        let element = $('#' + '{{ $modalName }}');
        element.modal('hide');
    })
</script>
@endpush