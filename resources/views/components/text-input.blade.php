@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full bg-white border-3 border-black text-black font-semibold rounded-xl px-4 py-3 placeholder-slate-500 focus:shadow-[4px_4px_0px_#000000] focus:-translate-x-0.5 focus:-translate-y-0.5 focus:outline-none transition-all duration-150']) }}>
