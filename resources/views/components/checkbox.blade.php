@props(['checked' => false])

<input
    {{ $attributes->merge(['type' => 'checkbox', 'class' => 'rounded border-gray-300 text-amber-600 shadow-sm focus:ring-amber-500']) }}
    @checked($checked)
/>