<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">{{ __('Room Types') }}</h2>
            <a href="{{ route('room-types.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-amber-600 text-white text-sm font-semibold rounded-md hover:bg-amber-700 shadow">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                {{ __('Add Room Type') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-200 rounded-md">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl overflow-hidden">
                <form method="GET" class="flex flex-wrap items-center justify-between gap-3 p-4 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                        <select name="per_page" onchange="this.form.submit()"
                                class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm focus:border-amber-500 focus:ring-amber-500">
                            @foreach ([10, 25, 50, 100] as $n)
                                <option value="{{ $n }}" @selected($perPage == $n)>{{ $n }}</option>
                            @endforeach
                        </select>
                        {{ __('entries per page') }}
                        <input type="number" name="capacity" value="{{ request('capacity') }}" placeholder="{{ __('Capacity') }}"
                               class="ml-4 w-28 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search by type name...') }}"
                               class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm focus:border-amber-500 focus:ring-amber-500">
                        <button class="px-3 py-1.5 bg-stone-800 dark:bg-gray-600 text-white text-sm rounded-md hover:bg-stone-700">{{ __('Go') }}</button>
                        @if(request()->hasAny(['search','capacity']))
                            <a href="{{ route('room-types.index') }}" class="px-3 py-1.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm rounded-md hover:bg-gray-300">{{ __('Reset') }}</a>
                        @endif
                    </div>
                </form>

                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700 text-left text-gray-600 dark:text-gray-300 uppercase text-xs tracking-wide">
                        <tr>
                            @php $cols = ['id' => __('ID'), 'type_name' => __('Type Name'), 'price_per_night' => __('Price / Night'), 'capacity' => __('Capacity')]; @endphp
                            @foreach ($cols as $key => $label)
                                <th class="px-4 py-3">
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => $key, 'direction' => $sort === $key && $direction === 'asc' ? 'desc' : 'asc']) }}"
                                       class="flex items-center gap-1 hover:text-amber-600">
                                        {{ $label }}
                                        @if ($sort === $key)
                                            <span>{{ $direction === 'asc' ? '▲' : '▼' }}</span>
                                        @else
                                            <span class="text-gray-300">↕</span>
                                        @endif
                                    </a>
                                </th>
                            @endforeach
                            <th class="px-4 py-3">{{ __('Rooms') }}</th>
                            <th class="px-4 py-3">{{ __('Description') }}</th>
                            <th class="px-4 py-3">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($roomTypes as $i => $type)
                            <tr class="{{ $i % 2 === 0 ? 'bg-white dark:bg-gray-800' : 'bg-gray-50/60 dark:bg-gray-700/40' }} hover:bg-amber-50/60 dark:hover:bg-gray-700">
                                <td class="px-4 py-3 font-semibold text-amber-600 dark:text-amber-400">{{ $type->id }}</td>
                                <td class="px-4 py-3 font-medium text-stone-800 dark:text-gray-100">{{ $type->type_name }}</td>
                                <td class="px-4 py-3 dark:text-gray-200">${{ number_format($type->price_per_night, 2) }}</td>
                                <td class="px-4 py-3 dark:text-gray-200">{{ $type->capacity }}</td>
                                <td class="px-4 py-3 dark:text-gray-200">{{ $type->rooms_count }}</td>
                                <td class="px-4 py-3 text-gray-500 dark:text-gray-400">{{ Str::limit($type->description, 40) ?: 'N/A' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <a href="{{ route('room-types.edit', $type) }}"
                                       class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded-md hover:bg-blue-700">
                                        {{ __('Edit') }}
                                    </a>
                                    <form method="POST" action="{{ route('room-types.destroy', $type) }}" class="inline"
                                          onsubmit="return confirm('Delete this room type? All its rooms will also be deleted.')">
                                        @csrf @method('DELETE')
                                        <button class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded-md hover:bg-red-700">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">{{ __('No room types found.') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="flex flex-wrap items-center justify-between gap-3 p-4 border-t border-gray-100 dark:border-gray-700 text-sm text-gray-600 dark:text-gray-300">
                    <span>{{ __('Showing') }} {{ $roomTypes->firstItem() ?? 0 }} {{ __('to') }} {{ $roomTypes->lastItem() ?? 0 }} {{ __('of') }} {{ $roomTypes->total() }} {{ __('entries') }}</span>
                    <div>{{ $roomTypes->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>