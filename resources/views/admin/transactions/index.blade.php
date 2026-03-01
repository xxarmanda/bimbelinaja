<x-admin-layout>

<div class="p-6 space-y-6">

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table id="excelTable" class="w-full border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">No</th>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">Pelajaran</th>
                    <th class="border px-3 py-2">Metode</th>
                    <th class="border px-3 py-2">Sesi</th>
                    <th class="border px-3 py-2">Total</th>
                    <th class="border px-3 py-2">Status</th>
                    <th class="border px-3 py-2">Tanggal Pendaftaran</th>
                    <th class="border px-3 py-2">Bukti</th>
                    <th class="border px-3 py-2">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($transactions as $transaction)
                @php
                    $notes = is_array($transaction->notes)
                        ? $transaction->notes
                        : json_decode($transaction->notes ?? '{}', true);
                @endphp

                <tr class="hover:bg-gray-50">
                    <td class="border px-3 py-2 text-center">{{ $loop->iteration }}</td>

                    <td class="border px-3 py-2 font-semibold">
                        {{ $transaction->guest_name }}
                        <div class="text-xs text-gray-500">
                            WA: {{ $notes['whatsapp'] ?? '-' }}
                        </div>
                    </td>

                    <td class="border px-3 py-2">
                        {{ $transaction->subProgram->name ?? '-' }}
                    </td>

                    {{-- METODE --}}
                    <td class="border px-3 py-2 text-center font-semibold text-indigo-600">
                        {{ ucfirst($transaction->learning_method) ?? '-' }}
                    </td>

                    {{-- SESI --}}
                    <td class="border px-3 py-2 text-center font-semibold">
                        {{ $transaction->sessions ?? '-' }} sesi
                    </td>

                    <td class="border px-3 py-2 font-bold text-green-600">
                        Rp {{ number_format($transaction->amount,0,',','.') }}
                    </td>

                    <td class="border px-3 py-2 text-center">
                        <span class="px-3 py-1 rounded text-xs font-bold
                            {{ $transaction->status == 'pending' 
                                ? 'bg-yellow-100 text-yellow-700' 
                                : 'bg-green-100 text-green-700' }}">
                            {{ strtoupper($transaction->status) }}
                        </span>
                    </td>

                    <td class="border px-3 py-2 text-center">
                        {{ optional($transaction->created_at)->format('d M Y') ?? '-' }}
                    </td>

                    <td class="border px-3 py-2 text-center">
                        @if($transaction->proof_of_payment)
                            <a href="{{ asset($transaction->proof_of_payment) }}"
                            target="_blank"
                            class="inline-flex items-center gap-1 px-3 py-1 bg-purple-600 text-white rounded text-xs font-semibold hover:bg-purple-700">
                                Lihat Bukti
                            </a>
                        @else
                            <span class="text-gray-400 italic text-xs">Belum upload</span>
                        @endif
                    </td>

                    <td class="border px-3 py-2 flex flex-wrap gap-1 justify-center">

                        <a href="{{ route('admin.transactions.show', $transaction->id) }}"
                           class="px-3 py-1 bg-blue-600 text-white rounded text-xs font-bold">
                            Detail
                        </a>

                        @if($transaction->status == 'pending')
                        <form action="{{ route('admin.transaction.verify', $transaction->id) }}"
                              method="POST"
                              onsubmit="return confirm('Verifikasi pembayaran ini?')">
                            @csrf
                            @method('PATCH')
                            <button class="px-3 py-1 bg-yellow-500 text-white rounded text-xs font-bold">
                                Terima
                            </button>
                        </form>
                        @endif

                        <form action="{{ route('admin.transactions.destroy', $transaction->id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded text-xs font-bold">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

</x-admin-layout>