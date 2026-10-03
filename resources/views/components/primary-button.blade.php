<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-amber-600 to-orange-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:from-amber-700 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition ease-in-out duration-150 shadow-md']) }}>
    {{ $slot }}
</button>
