<div class="bg-white rounded-[2.5rem] overflow-hidden shadow-2xl transition-transform hover:-translate-y-2 duration-500">

    {{-- Foto --}}
    <div class="h-64 relative overflow-hidden group">
        @php 
            $imgLink = str_replace('storage/', '', $t->image); 
        @endphp

        @if($t->image && file_exists(public_path($imgLink)))
            <img src="{{ asset($imgLink) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        @else
            <div class="w-full h-full bg-teal-100 flex items-center justify-center text-5xl">🎓</div>
        @endif

        <div class="absolute -bottom-6 left-8 w-12 h-12 bg-[#006064] rounded-2xl flex items-center justify-center shadow-xl border-4 border-white">
            <span class="text-white text-xl">“</span>
        </div>
    </div>

    {{-- Konten --}}
    <div class="p-10 pt-12 space-y-4">
        <p class="text-gray-500 italic leading-relaxed text-sm">
            {{ $t->testimony }}
        </p>

        <div class="pt-6 border-t border-gray-100">
            <h4 class="font-black text-[#006064] uppercase text-base">{{ $t->name }}</h4>
            <p class="text-[#FFC107] text-[10px] font-bold uppercase tracking-widest mt-1 italic">
                {{ $t->title }}
            </p>
        </div>
    </div>
</div>