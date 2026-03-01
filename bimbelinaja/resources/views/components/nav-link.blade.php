@props(['active', 'href', 'icon', 'label'])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-3 bg-gray-100 text-[#006064] rounded-xl font-black transition duration-200'
            : 'flex items-center p-3 text-gray-500 hover:bg-gray-50 hover:text-[#006064] rounded-xl font-medium transition duration-200';

$iconPaths = [
    'home' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
    'dashboard' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', // TAMBAHAN: Kunci dashboard
    'users' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
    'grid' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z',
    'user' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'
];
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    <svg class="w-6 h-6 shrink-0 md:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        {{-- Gunakan '??' agar jika ikon tidak ditemukan, aplikasi tidak crash --}}
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPaths[$icon] ?? $iconPaths['home'] }}"></path>
    </svg>
    <span class="hidden md:block">{{ $label }}</span>
</a>