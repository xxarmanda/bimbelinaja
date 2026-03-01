@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 bg-teal-50 text-[#006064] rounded-xl font-bold transition duration-200 border-r-4 border-[#FFC107]'
            : 'flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#006064] rounded-xl font-medium transition duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if(isset($icon))
        <svg class="w-6 h-6 shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
        </svg>
    @endif
    <span class="hidden md:block">{{ $slot }}</span>
</a>