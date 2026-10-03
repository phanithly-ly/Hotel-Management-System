<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">{{ __('Rooms') }}</h2>
            <a href="{{ route('rooms.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-amber-600 text-white text-sm font-semibold rounded-md hover:bg-amber-700 shadow">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                {{ __('Create Room') }}
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
                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 flex-wrap">
                        <select name="per_page" onchange="this.form.submit()"
                                class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm focus:border-amber-500 focus:ring-amber-500">
                            @foreach ([10, 25, 50, 100] as $n)
                                <option value="{{ $n }}" @selected($perPage == $n)>{{ $n }}</option>
                            @endforeach
                        </select>
                        {{ __('entries per page') }}

                        <select name="room_type_id" onchange="this.form.submit()"
                                class="ml-3 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm focus:border-amber-500 focus:ring-amber-500">
                            <option value="">{{ __('All Room Types') }}</option>
                            @foreach ($roomTypes as $type)
                                <option value="{{ $type->id }}" @selected(request('room_type_id') == $type->id)>{{ $type->type_name }}</option>
                            @endforeach
                        </select>

                        <select name="status" onchange="this.form.submit()"
                                class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm focus:border-amber-500 focus:ring-amber-500">
                            <option value="">{{ __('All Status') }}</option>
                            @foreach (['available', 'occupied', 'maintenance'] as $st)
                                <option value="{{ $st }}" @selected(request('status') === $st)>{{ __(ucfirst($st)) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center gap-2">
                        <label class="text-sm text-gray-600 dark:text-gray-300">{{ __('Search:') }}</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Room no. or type...') }}"
                               class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm focus:border-amber-500 focus:ring-amber-500">
                        <button class="px-3 py-1.5 bg-stone-800 dark:bg-gray-600 text-white text-sm rounded-md hover:bg-stone-700">{{ __('Go') }}</button>
                        @if(request()->hasAny(['search','status','room_type_id']))
                            <a href="{{ route('rooms.index') }}" class="px-3 py-1.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm rounded-md hover:bg-gray-300">{{ __('Reset') }}</a>
                        @endif
                    </div>
                </form>

                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700 text-left text-gray-600 dark:text-gray-300 uppercase text-xs tracking-wide">
                        <tr>
                            @php $cols = ['id' => __('ID'), 'room_number' => __('Room No.'), 'floor' => __('Floor'), 'status' => __('Status')]; @endphp
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
                            <th class="px-4 py-3">{{ __('Room Type') }}</th>
                            <th class="px-4 py-3">{{ __('Price / Night') }}</th>
                            <th class="px-4 py-3">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @php
                            $statusStyle = [
                                'available'   => 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200',
                                'occupied'    => 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200',
                                'maintenance' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-200',
                            ];
                        @endphp
                        @forelse ($rooms as $i => $room)
                            <tr class="{{ $i % 2 === 0 ? 'bg-white dark:bg-gray-800' : 'bg-gray-50/60 dark:bg-gray-700/40' }} hover:bg-amber-50/60 dark:hover:bg-gray-700">
                                <td class="px-4 py-3 font-semibold text-amber-600 dark:text-amber-400">{{ $room->id }}</td>
                                <td class="px-4 py-3 font-medium text-stone-800 dark:text-gray-100">{{ $room->room_number }}</td>
                                <td class="px-4 py-3 dark:text-gray-200">{{ $room->floor ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $statusStyle[$room->status] }}">{{ __(ucfirst($room->status)) }}</span>
                                </td>
                                <td class="px-4 py-3 dark:text-gray-200">{{ $room->roomType->type_name }}</td>
                                <td class="px-4 py-3 font-medium text-amber-600 dark:text-amber-400">${{ number_format($room->roomType->price_per_night, 2) }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <a href="{{ route('rooms.edit', $room) }}"
                                       class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded-md hover:bg-blue-700">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        {{ __('Edit') }}
                                    </a>
                                    <form method="POST" action="{{ route('rooms.destroy', $room) }}" class="inline"
                                          onsubmit="return confirm('{{ __('Delete this room?') }}')">
                                        @csrf @method('DELETE')
                                        <button class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded-md hover:bg-red-700">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16"/></svg>
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">{{ __('No rooms found.') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="flex flex-wrap items-center justify-between gap-3 p-4 border-t border-gray-100 dark:border-gray-700 text-sm text-gray-600 dark:text-gray-300">
                    <span>{{ __('Showing') }} {{ $rooms->firstItem() ?? 0 }} {{ __('to') }} {{ $rooms->lastItem() ?? 0 }} {{ __('of') }} {{ $rooms->total() }} {{ __('entries') }}</span>
                    <div>{{ $rooms->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>