<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitventory - Keranjang Belanja</title>
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
    <main class="max-w-7xl mx-auto px-6 py-8" 
          x-data="{ 
              items: JSON.parse(localStorage.getItem('fitventory_cart') || '[]'),
              shipping: 15000,
              get total() { return this.items.filter(i => i.selected).reduce((acc, i) => acc + (i.price * i.quantity), 0); },
              saveCart() { localStorage.setItem('fitventory_cart', JSON.stringify(this.items)); },
              removeItem(id) { this.items = this.items.filter(i => i.id !== id); this.saveCart(); }
          }" x-init="$watch('items', val => saveCart(), {deep: true})">
        
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Keranjang Belanja</h1>
            <p class="text-gray-500" x-text="`${items.length} item dalam keranjang`"></p>
        </div>

        <!-- Content Grid -->
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Left Column: Cart Items -->
            <div class="flex-[2] space-y-4">
                <template x-if="items.length === 0">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                        <p class="text-gray-500 mb-4 text-lg">Keranjang belanja kosong.</p>
                        <a href="/katalog" class="inline-flex justify-center items-center gap-2 bg-gradient-to-r from-[#a855f7] to-[#3b82f6] text-white font-medium px-6 py-2.5 rounded-lg hover:opacity-90 transition">
                            Belanja Sekarang
                        </a>
                    </div>
                </template>

                <template x-for="(item, index) in items" :key="item.id">
                <!-- Cart Item Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex flex-col sm:flex-row gap-5 hover:shadow-md transition-shadow">
                    
                    <!-- Checkbox -->
                    <div class="hidden sm:flex items-center justify-center pt-2">
                        <input type="checkbox" x-model="item.selected" @change="saveCart()" class="w-5 h-5 text-[#a855f7] rounded border-gray-300 focus:ring-[#a855f7]">
                    </div>

                    <!-- Details -->
                    <div class="flex-1 flex flex-col justify-between">
                        <!-- Top Row: Title & Delete -->
                        <div class="flex justify-between items-start">
                            <div class="flex items-start gap-4">
                                <div>
                                    <h3 class="font-semibold text-gray-900 text-lg leading-tight mb-1" x-text="item.name"></h3>
                                    <div class="flex items-center gap-2 text-xs mb-4">
                                        <span class="text-gray-600" x-text="'Size: ' + item.size"></span>
                                        <span class="text-gray-300">•</span>
                                        <span class="text-gray-600" x-text="'Color: ' + item.color"></span>
                                    </div>
                                </div>
                            </div>
                            <button @click="removeItem(item.id)" class="text-gray-400 hover:text-red-500 transition-colors p-2" title="Hapus dari keranjang">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>

                        <!-- Bottom Row: Qty & Price -->
                        <div class="flex justify-between items-end mt-auto">
                            <!-- Qty Selector -->
                            <div class="flex items-center border border-gray-200 rounded-lg bg-white overflow-hidden shadow-sm">
                                <button @click="if(item.quantity > 1) { item.quantity--; saveCart(); }" class="px-3 py-1.5 text-gray-600 hover:bg-gray-50 transition border-r border-gray-200">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" /></svg>
                                </button>
                                <span class="w-10 text-center text-sm font-semibold text-gray-800" x-text="item.quantity"></span>
                                <button @click="if(item.quantity < 10) { item.quantity++; saveCart(); }" class="px-3 py-1.5 text-gray-600 hover:bg-gray-50 transition border-l border-gray-200">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                                </button>
                            </div>

                            <!-- Individual Price -->
                            <div class="text-xl font-bold text-[#a855f7]" x-text="`Rp ${(item.price * item.quantity).toLocaleString('id-ID')}`"></div>
                        </div>
                    </div>
                </div>
                </template>

            </div>

            <!-- Right Column: Order Summary -->
            <div class="flex-[1]">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h2 class="text-lg font-bold text-gray-900 mb-6">Ringkasan Pesanan</h2>
                    <!-- Totals -->
                    <div class="mb-8">
                        <div class="flex justify-between text-gray-600 mb-3 text-[15px]">
                            <span>Subtotal</span>
                            <span class="font-medium text-gray-900" x-text="`Rp ${total.toLocaleString('id-ID')}`"></span>
                        </div>
                        <div class="flex justify-between text-gray-600 mb-4 text-[15px]">
                            <span>Estimasi Ongkir</span>
                            <span class="font-medium text-gray-900" x-text="total > 0 ? `Rp ${shipping.toLocaleString('id-ID')}` : 'Rp 0'"></span>
                        </div>
                        <hr class="border-gray-100 mb-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-900 font-semibold text-lg">Total</span>
                            <span class="text-[#a855f7] font-bold text-2xl" x-text="total > 0 ? `Rp ${(total + shipping).toLocaleString('id-ID')}` : 'Rp 0'"></span>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <button @click="localStorage.setItem('fitventory_checkout', JSON.stringify(items.filter(i => i.selected))); window.location.href='/checkout'"
                            :disabled="items.filter(i => i.selected).length === 0"
                            :class="items.filter(i => i.selected).length === 0 ? 'opacity-50 cursor-not-allowed' : 'hover:opacity-90'"
                            class="w-full bg-[#4f46e5] text-white py-4 rounded-xl font-semibold flex items-center justify-center gap-2 transition-opacity shadow-sm">
                        Lanjut ke Checkout
                    </button>

                    <!-- Promo Banner -->
                    <div class="bg-[#f0f9ff] text-[#0369a1] px-4 py-3 rounded-lg flex items-start gap-3 border border-[#bae6fd]">
                        <div class="mt-0.5 relative">
                            <span class="text-lg leading-none">💡</span>
                        </div>
                        <p class="text-xs font-medium leading-relaxed">
                            Gratis ongkir untuk pembelian di atas Rp 500.000
                        </p>
                    </div>

                </div>
            </div>

        </div>

    </main>

</body>
</html>
