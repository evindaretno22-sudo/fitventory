<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitventory - Pesanan Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .text-gradient {
            background: linear-gradient(90deg, #a855f7 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center sticky top-0 z-50 shadow-sm">
        <div class="text-2xl font-bold text-gradient">Fitventory</div>
        <div class="hidden md:flex items-center gap-8 text-sm font-medium">
            <a href="/katalog" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                Produk
            </a>
            <a href="/info-toko" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                Info Toko
            </a>
            <a href="/keranjang" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                Keranjang
            </a>
            <a href="/pesanan" class="flex items-center gap-2 text-[#a855f7] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                Pesanan Saya
            </a>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-[#6b21a8] text-white flex items-center justify-center font-bold text-lg">E</div>
                <div class="leading-tight">
                    <p class="font-semibold text-sm text-gray-800">evindajayanti5</p>
                    <p class="text-xs text-gray-500">Customer</p>
                </div>
            </div>
            <a href="/login" class="text-red-500 hover:text-red-700 transition ml-2" title="Keluar">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-6 py-10" 
          x-data="{ 
              hasOrder: true,
              items: JSON.parse(localStorage.getItem('fitventory_checkout') || '[]'),
              shipping: 15000,
              get total() { return this.items.reduce((acc, i) => acc + (i.price * i.quantity), 0); }
          }">
        
        <h1 class="text-[32px] font-medium text-gray-900 mb-1">Pesanan Saya</h1>
        <p class="text-gray-500 mb-8" x-text="hasOrder ? '1 pesanan' : '0 pesanan'"></p>

        <!-- Empty State (Simulasi jika belum ada order) -->
        <div x-show="!hasOrder" style="display: none;" class="bg-white rounded-xl shadow-[0_0_15px_rgba(0,0,0,0.03)] border border-gray-100 p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <p class="text-gray-500 mb-4 whitespace-pre-line text-lg">Belum ada pesanan.</p>
            <a href="/katalog" class="inline-flex justify-center items-center gap-2 bg-gradient-to-r from-[#a855f7] to-[#3b82f6] text-white font-medium px-6 py-2.5 rounded-lg hover:opacity-90 transition shadow-sm border border-transparent">
                Mulai Belanja
            </a>
            <!-- Tombol untuk test state terisi -->
            <button @click="hasOrder = true" class="block mx-auto mt-6 text-xs text-gray-400 hover:text-gray-600 underline">Lihat Contoh Pesanan</button>
        </div>

        <!-- Filled State -->
        <div x-show="hasOrder" class="bg-white rounded-xl shadow-[0_0_15px_rgba(0,0,0,0.03)] border border-gray-100 p-8 sm:p-10">
            
            <!-- Order Header -->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4 mb-6">
                <div>
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        <span class="text-gray-500 font-medium text-[15px]">Order ID: #ord17763</span>
                        <span class="bg-[#fef08a] text-[#854d0e] text-[12px] px-3 py-1 rounded-full flex items-center gap-1.5 font-medium border border-yellow-200 shadow-sm leading-none">
                            <svg class="w-4 h-4 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Menunggu Konfirmasi
                        </span>
                    </div>
                    <p class="text-[14px] text-gray-500">17 April 2026</p>
                </div>
                <div class="sm:text-right">
                    <p class="text-[13px] text-gray-500 mb-1">Total Pembayaran</p>
                    <p class="text-2xl font-medium text-[#a855f7]" x-text="`Rp ${(total + shipping).toLocaleString('id-ID')}`"></p>
                </div>
            </div>

            <hr class="border-gray-100 mb-6 relative">

            <!-- Item Detail -->
            <div class="space-y-4 mb-6">
                <template x-for="item in items" :key="item.id">
                    <div class="flex justify-between items-start">
                        <div class="text-gray-600">
                            <div class="font-medium text-[15px] text-gray-800" x-text="item.name"></div>
                            <div class="text-xs text-gray-500 mt-1" x-text="`Ukuran: ${item.size} | Warna: ${item.color}`"></div>
                            <div class="mt-1 text-sm" x-text="`(x${item.quantity})`"></div>
                        </div>
                        <span class="text-gray-900 font-medium text-[15px]" x-text="`Rp ${(item.price * item.quantity).toLocaleString('id-ID')}`"></span>
                    </div>
                </template>
            </div>

            <hr class="border-gray-100 mb-6">

            <!-- Payment Method & Buttons -->
            <div class="mb-10">
                <div class="mb-5">
                    <span class="text-gray-500 text-[14px]">Metode Pembayaran: </span>
                    <span class="text-gray-800 font-medium text-[14px]">
                        @if(request('metode') == 'cod')
                            Cash on Delivery (COD)
                        @elseif(request('metode') == 'ewallet')
                            E-Wallet
                        @elseif(request('metode') == 'qris')
                            QRIS
                        @else
                            Transfer Bank
                        @endif
                    </span>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <button class="bg-[#faf5ff] text-[#a855f7] hover:bg-purple-100 transition-colors px-6 py-2.5 rounded-lg text-[13px] font-medium">Lihat Detail</button>
                    <button @click="hasOrder = false" class="bg-red-50 text-red-500 hover:bg-red-100 transition-colors px-6 py-2.5 rounded-lg text-[13px] font-medium">Batalkan Pesanan</button>
                </div>
            </div>

            <!-- Progress Track -->
            <div class="relative w-full overflow-hidden pb-4 pt-6">
                <div class="w-full relative">
                    <!-- Base line mengcover dari tengah circle pertama hingga tengah circle terakhir -->
                    <div class="absolute top-[16px] left-[12.5%] right-[12.5%] h-[3px] bg-[#e5e7eb] z-0"></div>
                    
                    <div class="flex w-full relative z-10">
                        <!-- Step 1 (Active) -->
                        <div class="flex flex-col items-center w-1/4">
                            <div class="w-8 h-8 rounded-full bg-[#a855f7] flex items-center justify-center ring-[8px] ring-white">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span class="text-[#a855f7] text-[13px] font-medium mt-3 text-center whitespace-nowrap">Pending</span>
                        </div>
                        
                        <!-- Step 2 -->
                        <div class="flex flex-col items-center w-1/4">
                            <div class="w-8 h-8 rounded-full bg-white border-[3px] border-[#e5e7eb] flex items-center justify-center ring-[8px] ring-white">
                                <div class="w-2.5 h-2.5 rounded-full bg-[#e5e7eb]"></div>
                            </div>
                            <span class="text-gray-400 text-[13px] font-medium mt-3 text-center whitespace-nowrap">Dikemas</span>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex flex-col items-center w-1/4">
                            <div class="w-8 h-8 rounded-full bg-white border-[3px] border-[#e5e7eb] flex items-center justify-center ring-[8px] ring-white">
                                <div class="w-2.5 h-2.5 rounded-full bg-[#e5e7eb]"></div>
                            </div>
                            <span class="text-gray-400 text-[13px] font-medium mt-3 text-center whitespace-nowrap">Dikirim</span>
                        </div>

                        <!-- Step 4 -->
                        <div class="flex flex-col items-center w-1/4">
                            <div class="w-8 h-8 rounded-full bg-white border-[3px] border-[#e5e7eb] flex items-center justify-center ring-[8px] ring-white">
                                <div class="w-2.5 h-2.5 rounded-full bg-[#e5e7eb]"></div>
                            </div>
                            <span class="text-gray-400 text-[13px] font-medium mt-3 text-center whitespace-nowrap">Selesai</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
