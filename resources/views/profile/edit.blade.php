<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">{{ __('Profile') }}</h2>

            <div>
                <form id="photo-form" method="POST" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data" class="flex items-center gap-3">
                    @csrf
                    <img src="{{ auth()->user()->profilePhotoUrl() }}"
                         class="w-12 h-12 rounded-full object-cover border-2 border-amber-500">

                    <div class="flex flex-col items-start">
                        <label class="cursor-pointer text-xs font-semibold text-amber-700 dark:text-amber-300 bg-amber-50 dark:bg-gray-700 hover:bg-amber-100 dark:hover:bg-gray-600 px-3 py-1.5 rounded-full">
                            {{ __('Choose Photo') }}
                            <input id="photo-input" type="file" name="photo" accept="image/*" class="hidden">
                        </label>
                        <span id="photo-filename" class="text-[10px] text-gray-400 mt-0.5"></span>
                    </div>

                    <button id="upload-btn" type="submit" style="display:none"
                            class="inline-flex text-xs font-semibold text-white bg-amber-600 hover:bg-amber-700 px-3 py-1.5 rounded-full">
                        {{ __('Upload') }}
                    </button>
                </form>

                @error('photo')
                    <p class="text-xs text-red-600 mt-1 text-right">{{ $message }}</p>
                @enderror

                @if (session('status') === 'photo-updated')
                    <p class="text-xs text-green-600 mt-1 text-right">{{ __('Photo updated!') }}</p>
                @endif
            </div>
        </div>

        <script>
            document.getElementById('photo-input').addEventListener('change', function () {
                var file = this.files[0];
                document.getElementById('photo-filename').innerText = file ? file.name : '';
                document.getElementById('upload-btn').style.display = file ? 'inline-flex' : 'none';
            });
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white/85 dark:bg-gray-800/80 border border-white/60 dark:border-gray-700/50 shadow-lg sm:rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white/85 dark:bg-gray-800/80 border border-white/60 dark:border-gray-700/50 shadow-lg sm:rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white/85 dark:bg-gray-800/80 border border-white/60 dark:border-gray-700/50 shadow-lg sm:rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>