<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-sage-dark border border-transparent rounded-tix font-bold text-xs text-white uppercase tracking-widest hover:opacity-hover focus:outline-none transition ease-in-out duration-150 shadow-sm']) }}>
    {{ $slot }}
</button>
