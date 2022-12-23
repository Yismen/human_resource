@props([
'editing',
'footer' => true,
])

<form @if ($editing) wire:submit.prevent="update()" @else wire:submit.prevent="store()" @endif {{ $attributes->merge([
    'class' => 'needs-validation'
    ]) }} autocomplete="off">

    {{ $slot }}

    @if($footer)
    <div class="mt-3 border-top p-2">

        @if ($editing)
        <x-human_resource::button type="submit" color="warning" class="btn-sm">
            {{ str(__('human_resource::messages.update'))->headline() }}
        </x-human_resource::button>
        @else
        <x-human_resource::button type="submit" color="primary" class="btn-sm">
            {{ str(__('human_resource::messages.create'))->headline() }}
        </x-human_resource::button>
        @endif
    </div>
    @endif
</form>