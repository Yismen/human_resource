@props([
'type' => 'submit',
'color' => 'primary',
])

<button type="submit" {{ $attributes->merge([
    'class' => "btn btn-{$color} mb-3 bg-gradient"
    ]) }}>
    {{ $slot }}
</button>