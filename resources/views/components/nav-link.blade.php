@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center self-center h-9 px-4 rounded-full text-sm font-semibold leading-5 text-gray-900 dark:text-white bg-white/70 dark:bg-white/15 shadow-sm focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center self-center h-9 px-4 rounded-full text-sm font-medium leading-5 text-gray-600 dark:text-gray-300 hover:bg-white/50 dark:hover:bg-white/10 hover:text-gray-900 dark:hover:text-white focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>