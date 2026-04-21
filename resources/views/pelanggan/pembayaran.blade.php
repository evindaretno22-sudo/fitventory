<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitventory - Metode Pembayaran</title>
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
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                Produk
            </a>
            <a href="/info-toko" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                Info Toko
            </a>
            <a href="/keranjang" class="flex items-center gap-2 text-[#a855f7] relative">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                Keranjang
                <span class="absolute -top-1.5 -right-3.5 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border border-white">1</span>
            </a>
            <a href="/pesanan" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
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
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-6 py-10" 
          x-data="{ 
              selectedMethod: 'transfer',
              items: JSON.parse(localStorage.getItem('fitventory_checkout') || '[]'),
              shipping: 15000,
              get total() { return this.items.reduce((acc, i) => acc + (i.price * i.quantity), 0); }
          }">
        
        <!-- Back Link -->
        <a href="/checkout" class="inline-flex items-center gap-2 text-[#a855f7] hover:text-[#9333ea] transition-colors mb-6 font-medium">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali
        </a>

        <!-- Header -->
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Metode Pembayaran</h1>

        <!-- Content Grid -->
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Left Column: Payment Methods -->
            <div class="flex-[3]">
                <div class="bg-white rounded-xl shadow-[0_0_15px_rgba(0,0,0,0.03)] border border-gray-100 p-8">
                    
                    <h2 class="text-lg font-medium text-gray-800 mb-6 font-semibold">Pilih Metode Pembayaran</h2>
                    
                    <div class="space-y-4 text-gray-700">
                        <!-- COD -->
                        <div @click="selectedMethod = 'cod'"
                             :class="selectedMethod === 'cod' ? 'border-[#a855f7] ring-1 ring-[#a855f7] bg-purple-50/20 text-purple-900' : 'border-gray-200 hover:border-gray-300'"
                             class="rounded-xl border p-5 cursor-pointer transition-all flex items-center gap-5">
                            <div class="w-12 h-12 rounded-lg bg-gray-50 flex items-center justify-center shrink-0 text-gray-500"
                                 :class="selectedMethod === 'cod' ? 'bg-white text-[#a855f7]' : ''">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900 text-[15px]">Cash on Delivery (COD)</h3>
                                <p class="text-[13px] text-gray-500 mt-0.5">Bayar saat barang diterima</p>
                            </div>
                            <!-- Checkmark -->
                            <div x-show="selectedMethod === 'cod'" class="w-6 h-6 rounded-full bg-[#a855f7] text-white flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            </div>
                        </div>

                        <!-- Transfer Bank -->
                        <div @click="selectedMethod = 'transfer'"
                             :class="selectedMethod === 'transfer' ? 'border-[#a855f7] ring-1 ring-[#a855f7] bg-purple-50/20 text-purple-900' : 'border-gray-200 hover:border-gray-300'"
                             class="rounded-xl border p-5 cursor-pointer transition-all flex items-center gap-5">
                            <div class="w-12 h-12 rounded-lg bg-gray-50 flex items-center justify-center shrink-0 text-gray-500"
                                 :class="selectedMethod === 'transfer' ? 'bg-white text-[#a855f7]' : ''">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900 text-[15px]">Transfer Bank</h3>
                                <p class="text-[13px] text-gray-500 mt-0.5">BCA, Mandiri, BNI, BRI</p>
                            </div>
                            <!-- Checkmark -->
                            <div x-show="selectedMethod === 'transfer'" class="w-6 h-6 rounded-full bg-[#a855f7] text-white flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            </div>
                        </div>

                        <!-- E-Wallet -->
                        <div @click="selectedMethod = 'ewallet'"
                             :class="selectedMethod === 'ewallet' ? 'border-[#a855f7] ring-1 ring-[#a855f7] bg-purple-50/20 text-purple-900' : 'border-gray-200 hover:border-gray-300'"
                             class="rounded-xl border p-5 cursor-pointer transition-all flex items-center gap-5">
                            <div class="w-12 h-12 rounded-lg bg-gray-50 flex items-center justify-center shrink-0 text-gray-500"
                                 :class="selectedMethod === 'ewallet' ? 'bg-white text-[#a855f7]' : ''">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900 text-[15px]">E-Wallet</h3>
                                <p class="text-[13px] text-gray-500 mt-0.5">GoPay, OVO, DANA, ShopeePay</p>
                            </div>
                            <!-- Checkmark -->
                            <div x-show="selectedMethod === 'ewallet'" class="w-6 h-6 rounded-full bg-[#a855f7] text-white flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            </div>
                        </div>

                        <!-- QRIS -->
                        <div @click="selectedMethod = 'qris'"
                             :class="selectedMethod === 'qris' ? 'border-[#a855f7] ring-1 ring-[#a855f7] bg-purple-50/20 text-purple-900' : 'border-gray-200 hover:border-gray-300'"
                             class="rounded-xl border p-5 cursor-pointer transition-all flex items-center gap-5">
                            <div class="w-12 h-12 rounded-lg bg-gray-50 flex items-center justify-center shrink-0 text-gray-500"
                                 :class="selectedMethod === 'qris' ? 'bg-white text-[#a855f7]' : ''">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900 text-[15px]">QRIS</h3>
                                <p class="text-[13px] text-gray-500 mt-0.5">Scan QR untuk bayar</p>
                            </div>
                            <!-- Checkmark -->
                            <div x-show="selectedMethod === 'qris'" class="w-6 h-6 rounded-full bg-[#a855f7] text-white flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Konfirmasi Pesanan Button -->
                <a :href="`/pesanan?metode=` + selectedMethod" class="w-full bg-[#4f46e5] hover:opacity-90 transition-opacity text-white font-medium py-4 rounded-xl flex justify-center items-center gap-2 mt-6 shadow-sm">
                    Konfirmasi Pesanan
                </a>

            </div>

            <!-- Right Column: Order Summary (Detail Pesanan) -->
            <div class="flex-[2]">
                <div class="bg-white rounded-xl shadow-[0_0_15px_rgba(0,0,0,0.03)] border border-gray-100 p-8 sticky top-28">
                    <h2 class="text-[17px] font-medium text-gray-800 mb-6 font-semibold">Detail Pesanan</h2>
                    
                    <!-- Customer Info -->
                    <div class="space-y-4 mb-8 text-[14px]">
                        <div>
                            <p class="text-[13px] text-gray-500 mb-0.5">Penerima</p>
                            <p class="text-gray-800">{{ request('nama', 'Evinda Jayanti') }}</p>
                        </div>
                        <div>
                            <p class="text-[13px] text-gray-500 mb-0.5">Telepon</p>
                            <p class="text-gray-800">{{ request('telepon', '9988776655') }}</p>
                        </div>
                        <div>
                            <p class="text-[13px] text-gray-500 mb-0.5">Alamat</p>
                            <p class="text-gray-800">{{ request('alamat', 'jlk;k\'l\'oo]o]o') }}</p>
                        </div>
                    </div>

                    <hr class="border-gray-100 mb-6">

                    <!-- Product Info -->
                    <div class="mb-6 space-y-4">
                        <template x-for="item in items" :key="item.id">
                            <div>
                                <div class="font-medium text-gray-800" x-text="item.name"></div>
                                <div class="text-xs text-gray-500 mt-1" x-text="`Ukuran: ${item.size} | Warna: ${item.color}`"></div>
                                <div class="mt-1 text-sm text-gray-500" x-text="`(x${item.quantity})`"></div>
                            </div>
                        </template>
                    </div>

                    <!-- Subtotals -->
                    <div class="space-y-4 text-[14px] mb-8">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="text-gray-500" x-text="`Rp ${total.toLocaleString('id-ID')}`"></span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkir</span>
                            <span class="text-gray-500" x-text="`Rp ${shipping.toLocaleString('id-ID')}`"></span>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="flex justify-between items-center pt-2">
                        <span class="font-semibold text-gray-800 text-[16px]">Total</span>
                        <span class="text-lg font-medium text-[#a855f7]" x-text="`Rp ${(total + shipping).toLocaleString('id-ID')}`"></span>
                    </div>

                </div>
            </div>

        </div>

    </main>

</body>
</html>
