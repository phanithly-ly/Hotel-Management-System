@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm']) }}>