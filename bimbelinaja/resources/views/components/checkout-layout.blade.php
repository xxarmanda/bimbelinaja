<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - BimbelinAja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <nav class="bg-white shadow-sm py-5 px-10 flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center space-x-2">
            <div class="bg-[#006064] p-2 rounded-lg shadow-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <span class="text-2xl font-bold text-[#006064] uppercase tracking-tighter">Bimbelin<span class="text-teal-500">Aja</span></span>
        </div>
        <div class="text-gray-400 font-bold uppercase text-[10px] tracking-widest italic">
            Safe & Secure Checkout
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>
</body>
</html>