<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Profile Photo</h2>
        <p class="mt-1 text-sm text-gray-600">Upload a photo to personalize your account.</p>
    </header>

    <form method="POST" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data" class="mt-6 flex items-center gap-6">
        @csrf

        <img src="{{ auth()->user()->profilePhotoUrl() }}"
             class="w-20 h-20 rounded-full object-cover border-2 border-amber-500"
             alt="{{ auth()->user()->name }}">

        <div>
            <input type="file" name="photo" accept="image/*"
                   class="block text-sm text-gray-600
                          file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                          file:text-xs file:font-semibold file:uppercase file:tracking-wide
                          file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 cursor-pointer">
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />

            <x-primary-button class="mt-3">{{ __('Upload Photo') }}</x-primary-button>

            @if (session('status') === 'photo-updated')
                <p class="text-sm text-green-600 mt-2">Photo updated successfully.</p>
            @endif
        </div>
    </form>
</section>