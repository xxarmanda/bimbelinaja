<x-admin-layout>
    <x-slot name="header">
        Dashboard Admin
    </x-slot>

    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
        <h2 class="text-[#006064] font-black uppercase">Selamat Datang di BimbelinAja!</h2>
        <p class="text-gray-500 mt-2 font-medium">Sistem manajemen tutor dan program sudah siap digunakan.</p>
    </div>
</x-admin-layout> ```



---

### Langkah 3: Bersihkan Cache (Wajib di PowerShell)
Karena tadi kamu sempat error saat menggunakan `&&`, gunakan tanda titik koma ( `;` ) untuk menjalankan perintah pembersihan di PowerShell VS Code kamu:

```powershell
php artisan view:clear ; php artisan cache:clear