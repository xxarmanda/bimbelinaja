<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Program - {{ $selectedProgram->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .bg-edufio { background-color: #006064; }
        .text-edufio { color: #006064; }
        .dropdown:hover .dropdown-menu { opacity: 1; transform: translateY(0); pointer-events: auto; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 font-sans" x-data="{ mobileMenuOpen: false }">

    @include('layouts.nav')

    {{-- 2. HERO SECTION --}}
    <div class="bg-edufio text-white py-20 px-6 text-center">
        <div class="flex justify-center mb-4"><span class="text-4xl">🎓</span></div>
        <h1 class="text-4xl md:text-5xl font-bold mb-6 italic uppercase tracking-tighter text-white">Les Privat {{ $selectedProgram->name }}</h1>
        <div class="flex flex-wrap justify-center gap-4">
            <span class="border border-white/30 px-6 py-2 rounded-full text-sm font-semibold italic">Laman Daftar & coba quiz trial</span>
        </div>
    </div>

    <main class="max-w-7xl mx-auto py-12 px-6">
        
        {{-- 3. INFORMASI UTAMA --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 mb-16">
            <div class="grid lg:grid-cols-12 gap-0">
                <div class="lg:col-span-5 p-8 bg-gray-50 flex items-start justify-center">
                    <img src="{{ asset('storage/' . $selectedProgram->image) }}" alt="{{ $selectedProgram->name }}" class="w-full rounded-xl shadow-lg object-cover aspect-[4/3]">
                </div>

                <div class="lg:col-span-7 p-8">
                    <h2 class="text-3xl font-bold text-edufio mb-6 italic uppercase">Informasi Program</h2>
                    <table class="w-full text-left border-collapse">
                        <tbody>
                            <tr class="border-b border-gray-100 bg-gray-50">
                                <th class="py-4 px-4 font-bold text-gray-700 w-1/3 italic">Program</th>
                                <td class="py-4 px-4 text-gray-600 font-bold uppercase italic">Les Privat {{ $selectedProgram->name }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="py-4 px-4 font-bold text-gray-700 italic">Deskripsi</th>
                                <td class="py-4 px-4 text-gray-600 italic leading-relaxed">{{ $selectedProgram->description }}</td>
                            </tr>
                            <tr class="border-b border-gray-100 bg-gray-50">
                                <th class="py-4 px-4 font-bold text-gray-700 italic">Penyelenggara</th>
                                <td class="py-4 px-4 text-gray-600 font-medium">BimbelinAja</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="py-4 px-4 font-bold text-gray-700 italic">Harga</th>
                                <td class="py-4 px-4 font-black text-edufio text-xl italic">Rp {{ number_format($selectedProgram->price, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-10 flex flex-col md:flex-row gap-4 items-center bg-teal-50/50 p-6 rounded-2xl">
                        <a href="{{ route('kalkulator.biaya', $selectedProgram->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-black px-10 py-4 rounded-xl w-full md:w-auto text-center italic transition-all shadow-md">DAFTAR SEKARANG</a>                        
                        @if($selectedProgram->trial_link)
                            <a href="{{ $selectedProgram->trial_link }}" target="_blank" class="bg-white border-2 border-edufio text-edufio font-black px-10 py-4 rounded-xl w-full md:w-auto text-center italic transition-all shadow-md uppercase tracking-tight">MULAI QUIZIZZ 🎮</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. SUB-PROGRAM ITEMS --}}
        <div class="mb-20">
            <h2 class="text-3xl font-black text-edufio text-center mb-10 italic uppercase">Sub-Program Pelajaran</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($selectedProgram->items as $item)
                    <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all text-center group">
                        <div class="h-20 flex justify-center mb-6">
                            @if($item->icon)
                                <img src="{{ asset('storage/' . $item->icon) }}" class="h-full object-contain">
                            @else
                                <span class="text-5xl">🎓</span>
                            @endif
                        </div>
                        <h3 class="text-xl font-black text-edufio mb-2 uppercase">{{ $item->name }}</h3>
                        <p class="text-teal-600 font-bold text-xs uppercase mb-4 italic">Usia {{ $item->age_range }}</p>
                        <p class="text-gray-500 text-sm italic leading-relaxed">{{ $item->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 5. MANFAAT BELAJAR --}}
        <div class="bg-white p-12 rounded-[3rem] shadow-sm border border-gray-100 mb-20">
            <h2 class="text-3xl font-black text-edufio mb-10 italic uppercase">Manfaat Belajar di BimbelinAja</h2>
            <div class="grid md:grid-cols-2 gap-x-16 gap-y-10">
                @forelse($selectedProgram->benefits as $index => $benefit)
                    <div>
                        <h4 class="text-lg font-black text-edufio mb-2 italic">{{ $index + 1 }}. {{ $benefit->title }}</h4>
                        <p class="text-gray-500 text-sm italic leading-relaxed">{{ $benefit->description }}</p>
                    </div>
                @empty
                    <p class="text-gray-300 italic uppercase">Manfaat belum ditambahkan oleh admin.</p>
                @endforelse
            </div>
        </div>

        {{-- 6. KUIS INTERAKTIF --}}
        @if($selectedProgram->questions->count() > 0)
        <div x-data="quizApp()" x-cloak class="mt-20 max-w-5xl mx-auto">
            <div class="bg-white rounded-[3rem] shadow-2xl border border-gray-100 overflow-hidden">
                
                {{-- LAYAR AWAL --}}
                <template x-if="status === 'ready'">
                    <div class="p-16 text-center">
                        <h2 class="text-3xl font-black text-edufio uppercase italic mb-4">Percobaan Kuis: {{ $selectedProgram->name }}</h2>
                        <p class="text-gray-500 mb-8 font-medium">Kamu memiliki waktu 5 menit untuk menyelesaikan kuis ini.</p>
                        <button @click="startQuiz()" class="bg-edufio text-white px-16 py-5 rounded-2xl font-black uppercase italic shadow-xl">Mulai Simulasi</button>
                    </div>
                </template>

                {{-- LAYAR UTAMA --}}
                <template x-if="status === 'playing'">
                    <div class="p-8 md:p-12">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-10 border-b pb-6 gap-4">
                            <span class="bg-edufio text-white px-6 py-2 rounded-xl font-black text-xs italic uppercase">Soal <span x-text="currentIndex + 1"></span> / <span x-text="questions.length"></span></span>
                            <div :class="timer < 60 ? 'text-red-500 animate-pulse' : 'text-edufio'" class="font-black text-2xl flex items-center gap-2">
                                ⏱️ <span x-text="formatTime(timer)"></span>
                            </div>
                        </div>

                        <div class="grid lg:grid-cols-12 gap-10">
                            <div class="lg:col-span-8">
                                <h3 class="text-xl md:text-2xl font-bold text-gray-800 leading-relaxed mb-8 italic" x-text="questions[currentIndex].question_text"></h3>
                                <div class="grid gap-4">
                                    <template x-for="opt in ['A', 'B', 'C', 'D']">
                                        <button @click="selectAnswer(opt)" 
                                                :class="userAnswers[currentIndex] === opt ? 'border-edufio bg-teal-50' : 'border-gray-100 bg-gray-50/50'"
                                                class="p-5 rounded-2xl border-2 text-left transition-all flex items-center group">
                                            <span :class="userAnswers[currentIndex] === opt ? 'bg-edufio text-white' : 'bg-white text-gray-400'"
                                                  class="w-10 h-10 flex items-center justify-center rounded-xl font-black mr-4 shadow-sm" x-text="opt"></span>
                                            <span class="font-bold text-gray-700" x-text="questions[currentIndex]['option_' + opt.toLowerCase()]"></span>
                                        </button>
                                    </template>
                                </div>

                                <div class="flex justify-between items-center mt-12 pt-8 border-t">
                                    <button @click="prevQuestion()" :disabled="currentIndex === 0" class="text-gray-400 font-black uppercase text-xs italic disabled:opacity-30">⬅️ Sebelumnya</button>
                                    <button @click="nextQuestion()" class="bg-edufio text-white px-10 py-4 rounded-xl font-black uppercase text-xs italic shadow-lg">
                                        <span x-text="currentIndex === questions.length - 1 ? 'Selesai ✅' : 'Berikutnya ➡️'"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="lg:col-span-4 bg-gray-50 p-6 rounded-[2rem] border">
                                <p class="text-center text-[10px] font-black uppercase tracking-widest text-gray-400 mb-6">Navigasi Soal</p>
                                <div class="grid grid-cols-5 gap-2">
                                    <template x-for="(q, index) in questions">
                                        <button @click="currentIndex = index"
                                                :class="currentIndex === index ? 'bg-edufio text-white shadow-lg' : (userAnswers[index] ? 'bg-green-500 text-white' : 'bg-white text-gray-400 border')"
                                                class="h-10 rounded-lg font-black text-xs transition-all" x-text="index + 1"></button>
                                    </template>
                                </div>
                                <button @click="confirmSubmit()" class="w-full mt-8 bg-red-500 text-white py-4 rounded-xl font-black uppercase text-xs italic shadow-md">Akhiri Sesi</button>
                            </div>
                        </div>
                    </div>
                </template>

                {{-- LAYAR HASIL --}}
                <template x-if="status === 'finished'">
                    <div class="p-16 text-center">
                        <h2 class="text-4xl font-black text-edufio uppercase italic mb-10">Hasil Kamu</h2>
                        <div class="grid md:grid-cols-3 gap-6 mb-12">
                            <div class="bg-green-50 p-6 rounded-3xl border border-green-100">
                                <p class="text-[10px] font-black text-green-600 uppercase mb-2">Benar</p>
                                <h4 class="text-4xl font-black text-green-700" x-text="correctCount"></h4>
                            </div>
                            <div class="bg-red-50 p-6 rounded-3xl border border-red-100">
                                <p class="text-[10px] font-black text-red-600 uppercase mb-2">Salah</p>
                                <h4 class="text-4xl font-black text-red-700" x-text="wrongCount"></h4>
                            </div>
                            <div class="bg-edufio p-6 rounded-3xl shadow-xl text-white">
                                <p class="text-[10px] font-black text-white/50 uppercase mb-2">Skor</p>
                                <h4 class="text-5xl font-black italic" x-text="finalScore"></h4>
                            </div>
                        </div>
                        <button @click="location.reload()" class="bg-yellow-400 text-gray-900 px-12 py-4 rounded-2xl font-black uppercase italic shadow-lg">Ulangi Kuis</button>
                    </div>
                </template>
            </div>
        </div>
        <script>
        function quizApp() {
            return {
                status: 'ready',
                currentIndex: 0,
                timer: 300, 
                interval: null,
                questions: JSON.parse('{!! addslashes(json_encode($selectedProgram->questions)) !!}'),
                userAnswers: [],
                correctCount: 0,
                wrongCount: 0,
                finalScore: 0,

                startQuiz() {
                    this.userAnswers = new Array(this.questions.length).fill(null);
                    this.status = 'playing';
                    this.startTimer();
                },
                startTimer() {
                    this.interval = setInterval(() => {
                        if (this.timer > 0) this.timer--;
                        else this.finishQuiz();
                    }, 1000);
                },
                formatTime(seconds) {
                    const m = Math.floor(seconds / 60);
                    const s = seconds % 60;
                    return `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
                },
                selectAnswer(choice) { this.userAnswers[this.currentIndex] = choice; },
                nextQuestion() {
                    if (this.currentIndex < this.questions.length - 1) this.currentIndex++;
                    else this.confirmSubmit();
                },
                prevQuestion() { if (this.currentIndex > 0) this.currentIndex--; },
                confirmSubmit() { if (confirm('Selesaikan kuis sekarang?')) this.finishQuiz(); },
                finishQuiz() {
                    clearInterval(this.interval);
                    let correct = 0;
                    this.questions.forEach((q, i) => { if (this.userAnswers[i] === q.correct_answer) correct++; });
                    this.correctCount = correct;
                    this.wrongCount = this.questions.length - correct;
                    this.finalScore = Math.round((correct / this.questions.length) * 100);
                    this.status = 'finished';
                }
            }
        }
        </script>
        @endif
    </main>

    @include('layouts.footer')

</body>
</html>