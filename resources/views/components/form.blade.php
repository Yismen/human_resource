@props([
'editing',
'footer',
])

<form @if ($editing) wire:submit.prevent="update()" @else wire:submit.prevent="store()" @endif {{ $attributes->merge([
    'class' => 'needs-validation'
    ]) }} autocomplete="off">

    {{ $slot }}

    @isset($footer)
    <div class="mt-3 border-top p-2">
        {{ $footer }}
    </div>
    @endisset
</form>