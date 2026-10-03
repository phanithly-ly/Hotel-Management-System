@php
    $statCards = [
        ['label' => __('Total Rooms'), 'value' => $total,
         'badge' => 'bg-amber-100 text-amber-600 dark:bg-amber-900/40 dark:text-amber-300',
         'icon' => 'M3 21h18M5 21V7l8-4v18M13 21V11l6 3v7'],
        ['label' => __('Available'), 'value' => $available,
         'badge' => 'bg-green-100 text-green-600 dark:bg-green-900/40 dark:text-green-300',
         'icon' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['label' => __('Occupied'), 'value' => $occupied,
         'badge' => 'bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-300',
         'icon' => 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m5-3.13a4 4 0 100-8 4 4 0 000 8zm6 3.13a4 4 0 00-2-3.13M4 8.87a4 4 0 012-3.13'],
        ['label' => __('Maintenance'), 'value' => $maintenance,
         'badge' => 'bg-yellow-100 text-yellow-600 dark:bg-yellow-900/40 dark:text-yellow-300',
         'icon' => 'M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z'],
    ];

    $tileStyle = [
        'available'   => 'bg-green-50 text-green-700 border-green-200 hover:bg-green-100 dark:bg-green-900/30 dark:text-green-300 dark:border-green-800 dark:hover:bg-green-900/50',
        'occupied'    => 'bg-red-50 text-red-700 border-red-200 hover:bg-red-100 dark:bg-red-900/30 dark:text-red-300 dark:border-red-800 dark:hover:bg-red-900/50',
        'maintenance' => 'bg-yellow-50 text-yellow-700 border-yellow-200 hover:bg-yellow-100 dark:bg-yellow-900/30 dark:text-yellow-300 dark:border-yellow-800 dark:hover:bg-yellow-900/50',
    ];

    $pct = fn ($n) => $total ? round($n / $total * 100, 1) : 0;
    $card = 'bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700';
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">{{ __('Dashboard') }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ now()->locale(app()->getLocale())->translatedFormat('l, d F Y') }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('rooms.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-amber-600 text-white text-sm font-semibold rounded-md hover:bg-amber-700 shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    {{ __('Add Room') }}
                </a>
                <a href="{{ route('room-types.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-100 border border-gray-300 dark:border-gray-600 text-sm font-semibold rounded-md hover:bg-gray-50 dark:hover:bg-gray-600 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    {{ __('Add Room Type') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome --}}
            <div class="rounded-2xl bg-gradient-to-r from-amber-500 to-orange-600 p-6 text-white shadow-lg">
                <h3 class="text-xl font-bold">{{ __('Welcome back') }}, {{ auth()->user()->name }}</h3>
                <p class="mt-1 text-sm text-amber-50">{{ __("Here's what's happening at your hotel today.") }}</p>
            </div>

            {{-- Stat cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($statCards as $s)
                    <div class="{{ $card }} p-5 flex items-center gap-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl {{ $s['badge'] }}">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $s['icon'] }}"/></svg>
                        </span>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $s['label'] }}</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $s['value'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Occupancy --}}
                <div class="{{ $card }} p-6">
                    <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-4">{{ __('Occupancy Rate') }}</h3>

                    <div class="relative w-40 h-40 mx-auto">
                        <svg viewBox="0 0 120 120" class="w-full h-full -rotate-90">
                            <circle cx="60" cy="60" r="52" fill="none" stroke-width="12" class="stroke-gray-200 dark:stroke-gray-700"/>
                            <circle cx="60" cy="60" r="52" fill="none" stroke-width="12" stroke-linecap="round"
                                    class="stroke-amber-500" stroke-dasharray="{{ $occupancyRate * 3.2673 }} 326.73"/>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $occupancyRate }}%</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ __('Occupied') }}</span>
                        </div>
                    </div>

                    <div class="mt-6 flex h-2.5 w-full overflow-hidden rounded-full bg-gray-200 dark:bg-gray-700">
                        <div class="bg-green-500" style="width: {{ $pct($available) }}%"></div>
                        <div class="bg-red-500" style="width: {{ $pct($occupied) }}%"></div>
                        <div class="bg-yellow-500" style="width: {{ $pct($maintenance) }}%"></div>
                    </div>
                    <div class="mt-3 flex flex-wrap justify-between gap-2 text-xs text-gray-600 dark:text-gray-300">
                        <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>{{ __('Available') }} ({{ $available }})</span>
                        <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>{{ __('Occupied') }} ({{ $occupied }})</span>
                        <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-full bg-yellow-500"></span>{{ __('Maintenance') }} ({{ $maintenance }})</span>
                    </div>
                </div>

                {{-- Room map --}}
                <div class="{{ $card }} p-6 lg:col-span-2">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ __('Room Map') }}</h3>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ __('Click a room to edit it.') }}</span>
                    </div>

                    @forelse ($floors as $floor => $floorRooms)
                        <div class="flex items-start gap-4 py-3 {{ ! $loop->last ? 'border-b border-gray-100 dark:border-gray-700' : '' }}">
                            <div class="w-20 shrink-0 pt-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                {{ __('Floor') }} {{ $floor ?: '-' }}
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($floorRooms as $room)
                                    <a href="{{ route('rooms.edit', $room) }}"
                                       title="{{ $room->roomType->type_name ?? '' }} • ${{ number_format($room->roomType->price_per_night ?? 0, 2) }}"
                                       class="min-w-[3.5rem] text-center px-3 py-2 rounded-lg border text-sm font-semibold transition {{ $tileStyle[$room->status] ?? '' }}">
                                        {{ $room->room_number }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center text-gray-500 dark:text-gray-400">
                            {{ __('No rooms yet.') }}
                            <a href="{{ route('rooms.create') }}" class="text-amber-600 dark:text-amber-400 font-semibold hover:underline">{{ __('Add Room') }}</a>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Room types summary --}}
                <div class="{{ $card }} lg:col-span-2 overflow-hidden">
                    <div class="flex items-center justify-between p-6 pb-4">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ __('Room Types') }}</h3>
                        <a href="{{ route('room-types.index') }}" class="text-sm font-semibold text-amber-600 dark:text-amber-400 hover:underline">{{ __('View all') }}</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-700 text-left text-xs uppercase tracking-wide text-gray-600 dark:text-gray-300">
                                <tr>
                                    <th class="px-6 py-3">{{ __('Type Name') }}</th>
                                    <th class="px-4 py-3">{{ __('Price / Night') }}</th>
                                    <th class="px-4 py-3">{{ __('Capacity') }}</th>
                                    <th class="px-4 py-3">{{ __('Rooms') }}</th>
                                    <th class="px-4 py-3">{{ __('Available') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse ($roomTypes as $type)
                                    <tr class="hover:bg-amber-50/60 dark:hover:bg-gray-700/60">
                                        <td class="px-6 py-3 font-medium text-gray-900 dark:text-gray-100">{{ $type->type_name }}</td>
                                        <td class="px-4 py-3 font-medium text-amber-600 dark:text-amber-400">${{ number_format($type->price_per_night, 2) }}</td>
                                        <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ $type->capacity }}</td>
                                        <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ $type->rooms_count }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200">{{ $type->available_count }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-6 py-6 text-center text-gray-500 dark:text-gray-400">{{ __('No room types found.') }}</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Revenue + attention --}}
                <div class="space-y-6">
                    <div class="{{ $card }} p-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Est. Revenue Tonight') }}</p>
                        <p class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">${{ number_format($estRevenue, 2) }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Based on occupied rooms') }}</p>

                        <div class="my-4 border-t border-gray-100 dark:border-gray-700"></div>

                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Max Potential / Night') }}</p>
                        <p class="mt-1 text-xl font-semibold text-amber-600 dark:text-amber-400">${{ number_format($maxRevenue, 2) }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('If all non-maintenance rooms are booked') }}</p>
                    </div>

                    <div class="{{ $card }} p-6">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-3">{{ __('Needs Attention') }}</h3>
                        @forelse ($maintenanceRooms as $room)
                            <a href="{{ route('rooms.edit', $room) }}"
                               class="flex items-center justify-between py-2 {{ ! $loop->last ? 'border-b border-gray-100 dark:border-gray-700' : '' }} hover:text-amber-600 dark:hover:text-amber-400 text-gray-700 dark:text-gray-200">
                                <span class="font-medium">{{ $room->room_number }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $room->roomType->type_name ?? '' }} · {{ __('Floor') }} {{ $room->floor ?? '-' }}</span>
                            </a>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('No rooms under maintenance.') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>