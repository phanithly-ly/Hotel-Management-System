@csrf

<div class="mb-5">
    <label for="type_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Type Name') }}</label>
    <div class="flex items-center rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus-within:ring-2 focus-within:ring-amber-500 focus-within:border-amber-500 overflow-hidden">
        <span class="px-3 text-amber-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 18v-6a2 2 0 012-2h14a2 2 0 012 2v6M3 18h18M3 18v2M21 18v2M6 10V7a2 2 0 012-2h2a2 2 0 012 2v3"/></svg>
        </span>
        <input id="type_name" name="type_name" type="text" value="{{ old('type_name', $roomType->type_name) }}"
               placeholder="{{ __('e.g. Deluxe') }}" required
               class="flex-1 border-0 bg-transparent text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-0 py-2.5 pr-3">
    </div>
    <x-input-error :messages="$errors->get('type_name')" class="mt-1" />
</div>

<div class="mb-5">
    <label for="price_per_night" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Price per Night ($)') }}</label>
    <div class="flex items-center rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus-within:ring-2 focus-within:ring-amber-500 focus-within:border-amber-500 overflow-hidden">
        <span class="px-3 text-amber-500 font-semibold">$</span>
        <input id="price_per_night" name="price_per_night" type="number" step="0.01"
               value="{{ old('price_per_night', $roomType->price_per_night) }}" placeholder="65.00" required
               class="flex-1 border-0 bg-transparent text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-0 py-2.5 pr-3">
    </div>
    <x-input-error :messages="$errors->get('price_per_night')" class="mt-1" />
</div>

<div class="mb-5">
    <label for="capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Capacity') }}</label>
    <div class="flex items-center rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus-within:ring-2 focus-within:ring-amber-500 focus-within:border-amber-500 overflow-hidden">
        <span class="px-3 text-amber-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m5-3.13a4 4 0 100-8 4 4 0 000 8zm6 3.13a4 4 0 00-2-3.13M4 8.87a4 4 0 012-3.13"/></svg>
        </span>
        <input id="capacity" name="capacity" type="number" value="{{ old('capacity', $roomType->capacity) }}" placeholder="2" required
               class="flex-1 border-0 bg-transparent text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-0 py-2.5 pr-3">
    </div>
    <x-input-error :messages="$errors->get('capacity')" class="mt-1" />
</div>

<div class="mb-6">
    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Description') }}</label>
    <div class="flex rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus-within:ring-2 focus-within:ring-amber-500 focus-within:border-amber-500 overflow-hidden">
        <span class="px-3 pt-2.5 text-amber-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </span>
        <textarea id="description" name="description" rows="3" placeholder="{{ __('Optional description') }}"
                  class="flex-1 border-0 bg-transparent text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-0 py-2.5 pr-3">{{ old('description', $roomType->description) }}</textarea>
    </div>
    <x-input-error :messages="$errors->get('description')" class="mt-1" />
</div>

<div class="flex items-center justify-center gap-3">
    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-md hover:bg-green-700 shadow">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        {{ $roomType->exists ? __('Update') : __('Submit') }}
    </button>
    <a href="{{ route('room-types.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-100 text-sm font-semibold rounded-md hover:bg-gray-300 dark:hover:bg-gray-500">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        {{ __('Cancel') }}
    </a>
</div>