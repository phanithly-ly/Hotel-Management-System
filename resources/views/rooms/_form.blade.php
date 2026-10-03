@csrf

<div class="mb-5">
    <label for="room_number" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Room Number') }}</label>
    <div class="flex items-center rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus-within:ring-2 focus-within:ring-amber-500 focus-within:border-amber-500 overflow-hidden">
        <span class="px-3 text-amber-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M4 8h16M4 16h16M6 3v18M18 3v18"/></svg>
        </span>
        <input id="room_number" name="room_number" type="text" value="{{ old('room_number', $room->room_number) }}"
               placeholder="{{ __('e.g. 101') }}" required
               class="flex-1 border-0 bg-transparent text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-0 py-2.5 pr-3">
    </div>
    <x-input-error :messages="$errors->get('room_number')" class="mt-1" />
</div>

<div class="mb-5">
    <label for="room_type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Room Type') }}</label>
    <div class="flex items-center rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus-within:ring-2 focus-within:ring-amber-500 focus-within:border-amber-500 overflow-hidden">
        <span class="px-3 text-amber-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-5 5a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 9V4a1 1 0 011-1z"/></svg>
        </span>
        <select id="room_type_id" name="room_type_id" required
                class="flex-1 border-0 bg-transparent text-gray-900 dark:text-gray-100 focus:ring-0 py-2.5 pr-3">
            <option value="">{{ __('-- Select room type --') }}</option>
            @foreach ($roomTypes as $type)
                <option value="{{ $type->id }}" @selected(old('room_type_id', $room->room_type_id) == $type->id)>
                    {{ $type->type_name }} (${{ number_format($type->price_per_night, 2) }})
                </option>
            @endforeach
        </select>
    </div>
    <x-input-error :messages="$errors->get('room_type_id')" class="mt-1" />
</div>

<div class="mb-5">
    <label for="floor" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Floor') }}</label>
    <div class="flex items-center rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus-within:ring-2 focus-within:ring-amber-500 focus-within:border-amber-500 overflow-hidden">
        <span class="px-3 text-amber-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7l8-4v18M13 21V11l6 3v7"/></svg>
        </span>
        <input id="floor" name="floor" type="number" value="{{ old('floor', $room->floor) }}" placeholder="{{ __('e.g. 1') }}"
               class="flex-1 border-0 bg-transparent text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-0 py-2.5 pr-3">
    </div>
    <x-input-error :messages="$errors->get('floor')" class="mt-1" />
</div>

<div class="mb-5">
    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Status') }}</label>
    <div class="flex items-center rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus-within:ring-2 focus-within:ring-amber-500 focus-within:border-amber-500 overflow-hidden">
        <span class="px-3 text-amber-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        </span>
        <select id="status" name="status" required
                class="flex-1 border-0 bg-transparent text-gray-900 dark:text-gray-100 focus:ring-0 py-2.5 pr-3">
            @foreach (['available', 'occupied', 'maintenance'] as $st)
                <option value="{{ $st }}" @selected(old('status', $room->status ?? 'available') === $st)>{{ __(ucfirst($st)) }}</option>
            @endforeach
        </select>
    </div>
    <x-input-error :messages="$errors->get('status')" class="mt-1" />
</div>

<div class="mb-6">
    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Description') }}</label>
    <div class="flex rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus-within:ring-2 focus-within:ring-amber-500 focus-within:border-amber-500 overflow-hidden">
        <span class="px-3 pt-2.5 text-amber-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </span>
        <textarea id="description" name="description" rows="3" placeholder="{{ __('Optional description') }}"
                  class="flex-1 border-0 bg-transparent text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-0 py-2.5 pr-3">{{ old('description', $room->description) }}</textarea>
    </div>
    <x-input-error :messages="$errors->get('description')" class="mt-1" />
</div>

<div class="flex items-center justify-center gap-3">
    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-md hover:bg-green-700 shadow">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        {{ $room->exists ? __('Update') : __('Submit') }}
    </button>
    <a href="{{ route('rooms.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-100 text-sm font-semibold rounded-md hover:bg-gray-300 dark:hover:bg-gray-500">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        {{ __('Cancel') }}
    </a>
</div>