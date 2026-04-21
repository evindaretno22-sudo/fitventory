<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitventory - Katalog Produk</title>
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
            <a href="/katalog" class="flex items-center gap-2 text-[#a855f7]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M10 2a.75.75 0 01.374.1l6 3.5a.75.75 0 010 1.3l-6 3.5a.75.75 0 01-.748 0l-6-3.5a.75.75 0 010-1.3l6-3.5A.75.75 0 0110 2z" />
                  <path d="M9.626 10.3l-6 3.5a.75.75 0 000 1.3l6 3.5a.75.75 0 00.748 0l6-3.5a.75.75 0 000-1.3l-6-3.5a.75.75 0 00-.748 0z" />
                </svg>
                Produk
            </a>
            <a href="/info-toko" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                Info Toko
            </a>
            <a href="/keranjang" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Keranjang
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
    <main class="max-w-7xl mx-auto px-6 py-8" x-data="{ showVariantModal: false, selectedSize: null, selectedColor: null, selectedProduct: '', selectedPrice: 0, actionType: '' }">
        
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Katalog Produk</h1>
            <p class="text-gray-500">9 produk tersedia</p>
        </div>

        <!-- Search & Filter Bar -->
        <div class="flex flex-col sm:flex-row gap-4 mb-8">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" class="block w-full pl-11 pr-4 py-3.5 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#a855f7] focus:border-[#a855f7] transition" placeholder="Cari produk atau brand...">
            </div>
            
            <button class="bg-[#a855f7] hover:bg-[#9333ea] text-white px-8 py-3.5 rounded-xl font-semibold flex items-center justify-center gap-2 shadow-sm transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Filter
            </button>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            
            <!-- Product Card 1 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow group flex flex-col h-full cursor-pointer">
                <!-- Image Box -->
                <div class="h-64 bg-gradient-to-br from-[#e0e7ff] to-[#f3e8ff] flex items-center justify-center relative">
                    <img src="https://cdn-icons-png.flaticon.com/512/892/892454.png" alt="Icon" class="w-12 h-12 opacity-80 mix-blend-multiply group-hover:scale-110 transition-transform">
                    <span class="absolute bottom-4 text-xs font-medium text-gray-500">outer</span>
                </div>
                <!-- Content Box -->
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start gap-2 mb-1">
                            <h3 class="font-semibold text-gray-900 leading-tight">Vintage Denim Jacket</h3>
                            <span class="bg-[#fef08a] text-[#854d0e] text-[10px] font-bold px-2 py-0.5 rounded-md uppercase tracking-wider shrink-0">second</span>
                        </div>
                        <p class="text-xs text-gray-500 mb-2">Levi's</p>
                        <div class="flex items-center gap-2 text-xs text-gray-600 mb-4">
                            <span>Size: M</span>
                            <span class="text-gray-300">•</span>
                            <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-blue-600"></span> Blue</span>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between items-end mb-4">
                            <span class="text-xl font-bold text-[#a855f7]">Rp 250.000</span>
                            <span class="text-xs text-gray-500 mb-1">Stok: 3</span>
                        </div>
                        
                        <div class="flex gap-2">
                           <button @click="showVariantModal = true; selectedSize = null; selectedColor = null; selectedProduct = 'Vintage Denim Jacket'; selectedPrice = 250000; actionType = 'cart'" class="flex-1 bg-gradient-to-r from-[#a855f7] to-[#3b82f6] text-white py-2.5 rounded-lg text-sm font-medium flex items-center justify-center gap-2 hover:opacity-90 transition shadow-sm" title="Tambah ke Keranjang">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                           </button>
                           <button @click="showVariantModal = true; selectedSize = null; selectedColor = null; selectedProduct = 'Vintage Denim Jacket'; selectedPrice = 250000; actionType = 'buy'" class="flex-[3] flex items-center justify-center border border-[#a855f7] text-[#a855f7] py-2.5 rounded-lg text-sm font-medium hover:bg-purple-50 transition block text-center w-full">
                                Beli Langsung
                           </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Card 2 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow group flex flex-col h-full cursor-pointer">
                <!-- Image Box -->
                <div class="h-64 bg-gradient-to-br from-[#f3e8ff] to-[#e0e7ff] flex items-center justify-center relative">
                    <img src="https://cdn-icons-png.flaticon.com/512/892/892454.png" alt="Icon" class="w-12 h-12 opacity-80 mix-blend-multiply group-hover:scale-110 transition-transform">
                    <span class="absolute bottom-4 text-xs font-medium text-gray-500">hoodie</span>
                </div>
                <!-- Content Box -->
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start gap-2 mb-1">
                            <h3 class="font-semibold text-gray-900 leading-tight">Oversized Hoodie</h3>
                            <span class="bg-[#bbf7d0] text-[#166534] text-[10px] font-bold px-2 py-0.5 rounded-md uppercase tracking-wider shrink-0">new</span>
                        </div>
                        <p class="text-xs text-gray-500 mb-2">Uniqlo</p>
                        <div class="flex items-center gap-2 text-xs text-gray-600 mb-4">
                            <span>Size: L</span>
                            <span class="text-gray-300">•</span>
                            <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-black"></span> Black</span>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between items-end mb-4">
                            <span class="text-xl font-bold text-[#a855f7]">Rp 350.000</span>
                            <span class="text-xs text-gray-500 mb-1">Stok: 8</span>
                        </div>
                        
                        <div class="flex gap-2">
                           <button @click="showVariantModal = true; selectedSize = null; selectedColor = null; selectedProduct = 'Oversized Hoodie'; selectedPrice = 350000; actionType = 'cart'" class="flex-1 bg-gradient-to-r from-[#a855f7] to-[#3b82f6] text-white py-2.5 rounded-lg text-sm font-medium flex items-center justify-center gap-2 hover:opacity-90 transition shadow-sm" title="Tambah ke Keranjang">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                           </button>
                           <button @click="showVariantModal = true; selectedSize = null; selectedColor = null; selectedProduct = 'Oversized Hoodie'; selectedPrice = 350000; actionType = 'buy'" class="flex-[3] flex items-center justify-center border border-[#a855f7] text-[#a855f7] py-2.5 rounded-lg text-sm font-medium hover:bg-purple-50 transition block text-center w-full">
                                Beli Langsung
                           </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Card 3 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow group flex flex-col h-full cursor-pointer">
                <!-- Image Box -->
                <div class="h-64 bg-gradient-to-br from-[#e0e7ff] to-[#f3e8ff] flex items-center justify-center relative">
                    <img src="https://cdn-icons-png.flaticon.com/512/892/892454.png" alt="Icon" class="w-12 h-12 opacity-80 mix-blend-multiply group-hover:scale-110 transition-transform">
                    <span class="absolute bottom-4 text-xs font-medium text-gray-500">celana</span>
                </div>
                <!-- Content Box -->
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start gap-2 mb-1">
                            <h3 class="font-semibold text-gray-900 leading-tight">Cargo Pants</h3>
                            <span class="bg-[#fef08a] text-[#854d0e] text-[10px] font-bold px-2 py-0.5 rounded-md uppercase tracking-wider shrink-0">second</span>
                        </div>
                        <p class="text-xs text-gray-500 mb-2">Dickies</p>
                        <div class="flex items-center gap-2 text-xs text-gray-600 mb-4">
                            <span>Size: L</span>
                            <span class="text-gray-300">•</span>
                            <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-[#f5f5dc] border border-gray-200"></span> Khaki</span>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between items-end mb-4">
                            <span class="text-xl font-bold text-[#a855f7]">Rp 200.000</span>
                            <span class="text-xs text-gray-500 mb-1">Stok: 4</span>
                        </div>
                        
                        <div class="flex gap-2">
                           <button @click="showVariantModal = true; selectedSize = null; selectedColor = null; selectedProduct = 'Cargo Pants'; selectedPrice = 200000; actionType = 'cart'" class="flex-1 bg-gradient-to-r from-[#a855f7] to-[#3b82f6] text-white py-2.5 rounded-lg text-sm font-medium flex items-center justify-center gap-2 hover:opacity-90 transition shadow-sm" title="Tambah ke Keranjang">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                           </button>
                           <button @click="showVariantModal = true; selectedSize = null; selectedColor = null; selectedProduct = 'Cargo Pants'; selectedPrice = 200000; actionType = 'buy'" class="flex-[3] flex items-center justify-center border border-[#a855f7] text-[#a855f7] py-2.5 rounded-lg text-sm font-medium hover:bg-purple-50 transition block text-center w-full">
                                Beli Langsung
                           </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Card 4 -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow group flex flex-col h-full cursor-pointer">
                <!-- Image Box -->
                <div class="h-64 bg-gradient-to-br from-[#f3e8ff] to-[#e0e7ff] flex items-center justify-center relative">
                    <img src="https://cdn-icons-png.flaticon.com/512/892/892454.png" alt="Icon" class="w-12 h-12 opacity-80 mix-blend-multiply group-hover:scale-110 transition-transform">
                    <span class="absolute bottom-4 text-xs font-medium text-gray-500">dress</span>
                </div>
                <!-- Content Box -->
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start gap-2 mb-1">
                            <h3 class="font-semibold text-gray-900 leading-tight">Floral Dress</h3>
                            <span class="bg-[#bbf7d0] text-[#166534] text-[10px] font-bold px-2 py-0.5 rounded-md uppercase tracking-wider shrink-0">new</span>
                        </div>
                        <p class="text-xs text-gray-500 mb-2">Zara</p>
                        <div class="flex items-center gap-2 text-xs text-gray-600 mb-4">
                            <span>Size: M</span>
                            <span class="text-gray-300">•</span>
                            <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-pink-300"></span> Pink</span>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between items-end mb-4">
                            <span class="text-xl font-bold text-[#a855f7]">Rp 300.000</span>
                            <span class="text-xs text-gray-500 mb-1">Stok: 2</span>
                        </div>
                        
                        <div class="flex gap-2">
                           <button @click="showVariantModal = true; selectedSize = null; selectedColor = null; selectedProduct = 'Floral Dress'; selectedPrice = 300000; actionType = 'cart'" class="flex-1 bg-gradient-to-r from-[#a855f7] to-[#3b82f6] text-white py-2.5 rounded-lg text-sm font-medium flex items-center justify-center gap-2 hover:opacity-90 transition shadow-sm" title="Tambah ke Keranjang">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                           </button>
                           <button @click="showVariantModal = true; selectedSize = null; selectedColor = null; selectedProduct = 'Floral Dress'; selectedPrice = 300000; actionType = 'buy'" class="flex-[3] flex items-center justify-center border border-[#a855f7] text-[#a855f7] py-2.5 rounded-lg text-sm font-medium hover:bg-purple-50 transition block text-center w-full">
                                Beli Langsung
                           </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Variant Modal -->
        <div x-show="showVariantModal" style="display: none;" class="fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.outside="showVariantModal = false" class="bg-white rounded-2xl w-full max-w-sm p-6 relative shadow-xl transform transition-all">
                <button @click="showVariantModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <h2 class="text-xl font-bold text-gray-900 mb-5">Pilih Variasi</h2>
                
                <!-- Ukuran -->
                <div class="mb-5">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Ukuran</h3>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="size in ['M', 'L', 'XL', 'XXL']" :key="size">
                            <button type="button" @click="selectedSize = size"
                                    :class="selectedSize === size ? 'bg-[#a855f7] text-white border-[#a855f7]' : 'bg-white text-gray-700 border-gray-200 hover:border-[#a855f7]'"
                                    class="px-4 py-2 rounded-lg border font-medium text-sm transition-colors min-w-[3rem]"
                                    x-text="size"></button>
                        </template>
                    </div>
                </div>

                <!-- Warna -->
                <div class="mb-8">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Warna</h3>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="color in ['Hitam', 'Biru', 'Hijau', 'Putih']" :key="color">
                            <button type="button" @click="selectedColor = color"
                                    :class="selectedColor === color ? 'bg-[#a855f7] text-white border-[#a855f7]' : 'bg-white text-gray-700 border-gray-200 hover:border-[#a855f7]'"
                                    class="px-4 py-2 rounded-lg border font-medium text-sm transition-colors min-w-[4rem]"
                                    x-text="color"></button>
                        </template>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button @click="showVariantModal = false" class="flex-1 py-3 text-gray-600 font-medium bg-gray-50 hover:bg-gray-100 rounded-xl transition-colors">Batal</button>
                    <!-- Tombol Lanjut, non-aktif jika pilihan belum lengkap -->
                    <button @click="
                            const item = {
                                id: Date.now(),
                                name: selectedProduct,
                                price: selectedPrice,
                                size: selectedSize,
                                color: selectedColor,
                                quantity: 1,
                                selected: true
                            };
                            if (actionType === 'cart') {
                                let cart = JSON.parse(localStorage.getItem('fitventory_cart') || '[]');
                                cart.push(item);
                                localStorage.setItem('fitventory_cart', JSON.stringify(cart));
                                showVariantModal = false;
                                alert('Produk berhasil ditambahkan ke keranjang!');
                            } else {
                                localStorage.setItem('fitventory_checkout', JSON.stringify([item]));
                                window.location.href = '/checkout';
                            }
                        " 
                            :disabled="!selectedSize || !selectedColor" 
                            :class="(!selectedSize || !selectedColor) ? 'opacity-50 cursor-not-allowed' : 'hover:opacity-90'"
                            class="flex-[2] bg-gradient-to-r from-[#a855f7] to-[#3b82f6] text-white font-semibold py-3 rounded-xl transition-opacity">
                        Lanjut
                    </button>
                </div>
            </div>
        </div>

    </main>

</body>
</html>
