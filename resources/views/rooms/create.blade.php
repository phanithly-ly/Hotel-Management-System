<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">{{ __('Add Room') }}</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/75 dark:bg-gray-800/70 backdrop-blur-xl border border-white/60 dark:border-gray-700/50 shadow-xl rounded-2xl p-8">
                <h1 class="text-center text-2xl font-bold text-amber-600 dark:text-amber-500 uppercase tracking-wide mb-6">{{ __('Create Room') }}</h1>
                <form method="POST" action="{{ route('rooms.store') }}">
                    @include('rooms._form', ['room' => new \App\Models\Room])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>