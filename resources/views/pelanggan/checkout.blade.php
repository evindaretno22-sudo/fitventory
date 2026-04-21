<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitventory - Informasi Pengiriman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        <!-- Logo -->
        <div class="text-2xl font-bold text-gradient">
            Fitventory
        </div>

        <!-- Center Menu -->
        <div class="hidden md:flex items-center gap-8 text-sm font-medium">
            <a href="/katalog" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                Produk
            </a>
            <a href="/info-toko" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                Info Toko
            </a>
            <a href="/keranjang" class="flex items-center gap-2 text-[#a855f7] relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Keranjang
                <span class="absolute -top-1.5 -right-3.5 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border border-white">
                    1
                </span>
            </a>
            <a href="/pesanan" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                Pesanan Saya
            </a>
        </div>

        <!-- User Profile Area -->
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-[#6b21a8] text-white flex items-center justify-center font-bold text-lg">
                    E
                </div>
                <div class="leading-tight">
                    <p class="font-semibold text-sm text-gray-800">evindajayanti5</p>
                    <p class="text-xs text-gray-500">Customer</p>
                </div>
            </div>
            
            <a href="/login" class="text-red-500 hover:text-red-700 transition ml-2" title="Keluar">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-6 py-10"
          x-data="{ 
              items: JSON.parse(localStorage.getItem('fitventory_checkout') || '[]'),
              shipping: 15000,
              get total() { return this.items.reduce((acc, i) => acc + (i.price * i.quantity), 0); }
          }">
        
        <!-- Back Link -->
        <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-[#a855f7] hover:text-[#9333ea] transition-colors mb-6 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>

        <!-- Header -->
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Informasi Pengiriman</h1>

        <!-- Content Grid -->
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Left Column: Shipping Form -->
            <div class="flex-[3]">
                <div class="bg-white rounded-xl shadow-[0_0_15px_rgba(0,0,0,0.03)] border border-gray-100 p-8">
                    
                    <form action="/pembayaran" method="GET" class="space-y-6 text-gray-600 font-medium">
                        
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="nama" class="block text-sm mb-2 text-gray-600">Nama Lengkap <span class="text-gray-400">*</span></label>
                            <input type="text" id="nama" name="nama" class="w-full rounded-xl border border-gray-200 focus:border-[#a855f7] focus:ring focus:ring-[#a855f7] focus:ring-opacity-20 py-3 px-4 outline-none transition-all text-gray-900" placeholder="">
                        </div>

                        <!-- Nomor Telepon -->
                        <div>
                            <label for="telepon" class="block text-sm mb-2 text-gray-600">Nomor Telepon <span class="text-gray-400">*</span></label>
                            <input type="tel" id="telepon" name="telepon" class="w-full rounded-xl border border-gray-200 focus:border-[#a855f7] focus:ring focus:ring-[#a855f7] focus:ring-opacity-20 py-3 px-4 outline-none transition-all text-gray-900" placeholder="08xxxxxxxxxx">
                        </div>

                        <!-- Alamat Lengkap -->
                        <div>
                            <label for="alamat" class="block text-sm mb-2 text-gray-600">Alamat Lengkap <span class="text-gray-400">*</span></label>
                            <textarea id="alamat" name="alamat" rows="4" class="w-full rounded-xl border border-gray-200 focus:border-[#a855f7] focus:ring focus:ring-[#a855f7] focus:ring-opacity-20 py-3 px-4 outline-none transition-all text-gray-900 resize-y" placeholder="Jl. Nama Jalan, No. XX, Kecamatan, Kota, Provinsi, Kode Pos"></textarea>
                        </div>

                        <!-- Lanjut ke Pembayaran Button -->
                        <button type="submit" class="w-full bg-[#4f46e5] hover:opacity-90 transition-opacity text-white font-semibold py-4 rounded-xl flex justify-center items-center gap-2 mt-8 shadow-sm">
                            Lanjut ke Pembayaran
                        </button>
                    </form>

                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="flex-[2]">
                <div class="bg-white rounded-xl shadow-[0_0_15px_rgba(0,0,0,0.03)] border border-gray-100 p-8 sticky top-28">
                    <h2 class="text-xl font-medium text-gray-800 mb-6 font-semibold">Ringkasan Pesanan</h2>
                    
                    <!-- Items -->
                    <div class="mb-8 space-y-4">
                        <template x-for="item in items" :key="item.id">
                            <div class="flex justify-between items-start text-[15px]">
                                <div class="text-gray-600 leading-snug">
                                    <div class="font-medium text-gray-800" x-text="item.name"></div>
                                    <div class="text-xs text-gray-500 mt-1" x-text="`Ukuran: ${item.size} | Warna: ${item.color}`"></div>
                                    <div class="mt-1 text-sm text-gray-500" x-text="`(x${item.quantity})`"></div>
                                </div>
                                <div class="text-right text-sm">
                                    <div class="text-gray-900 font-medium" x-text="`Rp ${(item.price * item.quantity).toLocaleString('id-ID')}`"></div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <hr class="border-gray-100 mb-6">

                    <!-- Subtotals -->
                    <div class="space-y-4 text-[15px] mb-8">
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
                        <span class="font-semibold text-gray-800 text-lg">Total</span>
                        <span class="text-xl font-medium text-[#a855f7]" x-text="`Rp ${(total + shipping).toLocaleString('id-ID')}`"></span>
                    </div>

                </div>
            </div>

        </div>

    </main>

</body>
</html>
