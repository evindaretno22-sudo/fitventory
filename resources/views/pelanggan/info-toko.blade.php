<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitventory - Informasi Toko</title>
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
            <a href="/info-toko" class="flex items-center gap-2 text-[#a855f7]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
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
    <main class="max-w-7xl mx-auto px-6 py-8">
        
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Informasi Toko</h1>
            <p class="text-gray-500">Kunjungi kami atau hubungi untuk informasi lebih lanjut</p>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            
            <!-- Left Card: Contact List -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <h2 class="text-2xl font-semibold text-gray-900 mb-8">Fitventory Thrift Store</h2>
                
                <div class="space-y-8">
                    <!-- Alamat -->
                    <div class="flex gap-4">
                        <div class="w-12 h-12 shrink-0 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 text-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm text-gray-500 mb-1">Alamat</h3>
                            <p class="text-gray-900 font-medium leading-relaxed mb-2">Jl. Pahlawan No. 456, Jakarta Pusat, DKI Jakarta 10110</p>
                            <a href="#" class="text-purple-600 hover:text-purple-700 font-medium text-sm inline-flex items-center gap-1 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                Buka di Google Maps
                            </a>
                        </div>
                    </div>

                    <!-- Telepon -->
                    <div class="flex gap-4">
                        <div class="w-12 h-12 shrink-0 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500 text-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm text-gray-500 mb-1">Telepon</h3>
                            <p class="text-gray-900 font-medium text-lg">021-12345678</p>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="flex gap-4">
                        <div class="w-12 h-12 shrink-0 rounded-xl bg-green-50 flex items-center justify-center text-green-500 text-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm text-gray-500 mb-1">WhatsApp</h3>
                            <p class="text-gray-900 font-medium text-lg mb-2">6281234567890</p>
                            <a href="#" class="inline-flex items-center gap-2 bg-[#25D366] hover:bg-[#20bd5a] text-white px-5 py-2.5 rounded-xl font-medium transition shadow-sm shadow-[#25D366]/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                Chat WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Instagram -->
                    <div class="flex gap-4">
                        <div class="w-12 h-12 shrink-0 rounded-xl bg-pink-50 flex items-center justify-center text-[#db2777] text-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                              <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                              <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm text-gray-500 mb-1">Instagram</h3>
                            <p class="text-gray-900 font-medium text-lg">@fitventory_thrift</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Cards -->
            <div class="flex flex-col gap-6">
                
                <!-- Tentang Kami -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Tentang Kami</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Toko thrift terpercaya dengan koleksi fashion berkualitas. Kami menyediakan berbagai macam pakaian branded second dan new dengan harga terjangkau.
                    </p>
                </div>

                <!-- Peta Lokasi -->
                <div class="bg-gradient-to-br from-[#f3e8ff] to-[#e0e7ff] rounded-2xl shadow-sm border border-gray-100 p-10 flex flex-col items-center justify-center relative overflow-hidden group">
                    <div class="text-[#a855f7] mb-2 group-hover:-translate-y-1 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <p class="text-gray-700 font-medium text-lg text-center absolute bottom-4">Peta Lokasi</p>
                    <div class="absolute bottom-4 right-4">
                       <a href="#" class="bg-white text-gray-800 hover:text-purple-600 px-4 py-2 rounded-lg font-medium text-sm flex items-center gap-2 shadow-sm transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Buka Maps
                       </a>
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        Jam Operasional
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-gray-600">
                            <span>Senin - Jumat</span>
                            <span class="font-medium text-gray-900">09:00 - 21:00</span>
                        </div>
                        <hr class="border-gray-100">
                        <div class="flex justify-between items-center text-gray-600">
                            <span>Sabtu - Minggu</span>
                            <span class="font-medium text-gray-900">10:00 - 22:00</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Action Buttons Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-8">
            <a href="#" class="bg-[#10b981] hover:bg-[#059669] text-white py-5 px-4 rounded-xl flex flex-col items-center justify-center gap-3 transition shadow-sm hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <span class="font-semibold">Chat WhatsApp</span>
            </a>
            
            <a href="#" class="bg-[#3b82f6] hover:bg-[#2563eb] text-white py-5 px-4 rounded-xl flex flex-col items-center justify-center gap-3 transition shadow-sm hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <span class="font-semibold">Telepon</span>
            </a>

            <a href="#" class="bg-[#db2777] hover:bg-[#be185d] text-white py-5 px-4 rounded-xl flex flex-col items-center justify-center gap-3 transition shadow-sm hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                  <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                  <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                </svg>
                <span class="font-semibold">Instagram</span>
            </a>

            <a href="#" class="bg-[#a855f7] hover:bg-[#9333ea] text-white py-5 px-4 rounded-xl flex flex-col items-center justify-center gap-3 transition shadow-sm hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="font-semibold">Lihat Map</span>
            </a>
        </div>

    </main>

</body>
</html>
