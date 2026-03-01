<x-admin-layout>
    <div class="p-10 pb-32">
        <div class="mb-10">
            <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">Pesan Masuk</h2>
            <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-2">Daftar aspirasi, kritik, dan saran dari pengunjung website</p>
        </div>

        @if(session('success'))
            <div class="bg-teal-50 border-2 border-teal-100 text-[#006064] p-6 rounded-[2rem] mb-10 font-bold text-sm italic text-center">
                {{ session('success') }} ✨
            </div>
        @endif

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-6 text-[10px] font-black text-[#006064] uppercase tracking-widest">Pengirim</th>
                        <th class="px-8 py-6 text-[10px] font-black text-[#006064] uppercase tracking-widest">Isi Pesan</th>
                        <th class="px-8 py-6 text-[10px] font-black text-[#006064] uppercase tracking-widest">Tanggal</th>
                        <th class="px-8 py-6 text-[10px] font-black text-[#006064] uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($messages as $msg)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="font-black text-[#006064] text-xs uppercase italic">{{ $msg->name }}</div>
                            <div class="text-gray-400 text-[10px] font-bold">{{ $msg->email }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-gray-500 text-xs italic font-medium leading-relaxed max-w-md line-clamp-2">{{ $msg->message }}</p>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-gray-400 font-bold text-[10px] uppercase">{{ $msg->created_at->format('d M Y') }}</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-50 text-red-500 p-3 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-24 text-center">
                            <div class="text-gray-300 font-black uppercase text-xs italic tracking-widest">Belum ada pesan masuk dari pengunjung.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            {{ $messages->links() }}
        </div>
    </div>
</x-admin-layout>