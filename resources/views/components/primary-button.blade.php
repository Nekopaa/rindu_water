<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-[#2563eb] text-white font-extrabold text-xs uppercase tracking-widest rounded-xl border-3 border-black shadow-[4px_4px_0px_#000000] hover:shadow-[6px_6px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:shadow-[2px_2px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:scale-[0.99] focus:outline-none transition-all duration-150']) }}>
    {{ $slot }}
</button>
