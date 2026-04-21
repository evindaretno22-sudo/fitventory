<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitventory - Admin Dashboard</title>
    <meta name="description" content="Panel admin Fitventory untuk mengelola inventory, melihat profit, dan memantau aktivitas toko">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .text-gradient {
            background: linear-gradient(90deg, #a855f7 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            color: #4b5563;
            transition: all 0.18s;
            text-decoration: none;
            cursor: pointer;
        }
        .sidebar-link:hover {
            background: #f3e8ff;
            color: #7c3aed;
        }
        .sidebar-link.active {
            background: linear-gradient(90deg, #a855f7, #3b82f6);
            color: #fff;
            box-shadow: 0 2px 12px rgba(168,85,247,0.25);
        }
        .sidebar-link.active svg {
            color: #fff;
        }
        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            border: 1px solid #f1f5f9;
        }
        .profit-card {
            border-radius: 18px;
            padding: 24px 28px;
            color: white;
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        }
        .scrollbar-thin::-webkit-scrollbar { width: 4px; height: 4px; }
        .scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
        .scrollbar-thin::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen" x-data="{ page: 'dashboard', sidebarOpen: true }">

<div class="flex min-h-screen">

    <!-- ===== SIDEBAR ===== -->
    <aside class="w-56 bg-white border-r border-gray-100 flex flex-col py-6 px-3 fixed h-full z-30 shadow-sm" style="min-height:100vh">

        <!-- Logo -->
        <div class="px-2 mb-6">
            <span class="text-xl font-bold text-gradient">Fitventory</span>
        </div>

        <!-- User -->
        <div class="flex items-center gap-3 px-2 mb-6">
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#a855f7] to-[#3b82f6] text-white flex items-center justify-center font-bold text-base flex-shrink-0">E</div>
            <div class="leading-tight overflow-hidden">
                <p class="font-semibold text-sm text-gray-800 truncate">evindajayanti5</p>
                <p class="text-xs text-gray-400">Admin</p>
            </div>
        </div>

        <!-- Search -->
        <div class="relative mx-1 mb-5">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" placeholder="Cari menu..." class="w-full pl-8 pr-3 py-2 text-xs bg-gray-50 border border-gray-200 rounded-lg outline-none focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition">
        </div>

        <!-- Nav Menu -->
        <nav class="flex flex-col gap-1 flex-1 overflow-y-auto scrollbar-thin">

            <a @click="page = 'dashboard'" :class="page === 'dashboard' ? 'active' : ''" class="sidebar-link" id="nav-dashboard">
                <svg class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"/>
                </svg>
                Dashboard
            </a>

            <a @click="page = 'produk'" :class="page === 'produk' ? 'active' : ''" class="sidebar-link" id="nav-produk">
                <svg class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Manajemen Produk
            </a>

            <a @click="page = 'stokmasuk'" :class="page === 'stokmasuk' ? 'active' : ''" class="sidebar-link" id="nav-stokmasuk">
                <svg class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                Stok Masuk
            </a>

            <a @click="page = 'stokkeluar'" :class="page === 'stokkeluar' ? 'active' : ''" class="sidebar-link" id="nav-stokkeluar">
                <svg class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                </svg>
                Stok Keluar
            </a>

            <a @click="page = 'aktivitas'" :class="page === 'aktivitas' ? 'active' : ''" class="sidebar-link" id="nav-aktivitas">
                <svg class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Riwayat &amp; Aktivitas
            </a>

            <a @click="page = 'laporan'" :class="page === 'laporan' ? 'active' : ''" class="sidebar-link" id="nav-laporan">
                <svg class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Laporan Penjualan
            </a>

            <a @click="page = 'customer'" :class="page === 'customer' ? 'active' : ''" class="sidebar-link" id="nav-customer">
                <svg class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Kelola Customer
            </a>

            <a @click="page = 'pengaturan'" :class="page === 'pengaturan' ? 'active' : ''" class="sidebar-link" id="nav-pengaturan">
                <svg class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Pengaturan
            </a>
        </nav>

        <!-- Logout -->
        <div class="mt-4 border-t border-gray-100 pt-4 px-1">
            <a href="/login" id="btn-logout" class="sidebar-link text-red-500 hover:text-red-600 hover:bg-red-50">
                <svg class="h-4 w-4 flex-shrink-0 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </a>
        </div>

    </aside>
    <!-- ===== END SIDEBAR ===== -->

    <!-- ===== MAIN CONTENT ===== -->
    <main class="flex-1 ml-56 min-h-screen">

        <!-- ========================= -->
        <!-- PAGE: DASHBOARD           -->
        <!-- ========================= -->
        <div x-show="page === 'dashboard'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-8">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-gray-500 text-sm mt-1">Selamat datang di Fitventory Admin Panel</p>
            </div>

            <!-- ===== ROW 1: Stat Cards (Produk & Profit Ringkasan) ===== -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-5">
                <!-- Total Produk Tersedia -->
                <div class="stat-card">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-[#a855f7]">Total Produk Tersedia</p>
                            <p class="text-4xl font-bold text-gray-900 mt-2">39</p>
                        </div>
                        <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center">
                            <svg class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Produk Terjual -->
                <div class="stat-card">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Produk Terjual</p>
                            <p class="text-4xl font-bold text-gray-900 mt-2">50</p>
                        </div>
                        <div class="w-11 h-11 bg-green-50 rounded-xl flex items-center justify-center">
                            <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Profit (ringkasan) -->
                <div class="stat-card">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-[#a855f7]">Total Profit</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">Rp 350.000</p>
                        </div>
                        <div class="w-11 h-11 bg-purple-50 rounded-xl flex items-center justify-center">
                            <svg class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== ROW 2: Profit Detail Cards (Modal, Pendapatan, Profit) ===== -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
                <div class="profit-card" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                    <p class="text-sm font-medium text-blue-100 mb-1">$ Total Modal</p>
                    <p class="text-3xl font-bold">Rp 450.000</p>
                </div>
                <div class="profit-card" style="background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);">
                    <p class="text-sm font-medium text-green-100 mb-1 flex items-center gap-1">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        Total Pendapatan
                    </p>
                    <p class="text-3xl font-bold">Rp 800.000</p>
                </div>
                <div class="profit-card" style="background: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%);">
                    <p class="text-sm font-medium text-purple-100 mb-1 flex items-center gap-1">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Total Profit
                    </p>
                    <p class="text-3xl font-bold">Rp 350.000</p>
                    <p class="text-sm text-purple-200 mt-1">(77.8%)</p>
                </div>
            </div>

            <!-- ===== Grafik Penjualan ===== -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8">
                <h2 class="text-lg font-bold text-gray-800 mb-5">Grafik Penjualan (7 Hari Terakhir)</h2>
                <canvas id="salesChart" height="90"></canvas>
            </div>

            <!-- ===== Tabel Detail Profit Per Produk (di bawah grafik) ===== -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8">
                <h2 class="text-lg font-bold text-gray-800 mb-5">Detail Profit Per Produk</h2>
                <div class="overflow-x-auto scrollbar-thin">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider pb-3 pr-4">Produk</th>
                                <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider pb-3 pr-4">Brand</th>
                                <th class="text-right text-xs font-bold text-gray-500 uppercase tracking-wider pb-3 pr-4">Harga Modal</th>
                                <th class="text-right text-xs font-bold text-gray-500 uppercase tracking-wider pb-3 pr-4">Harga Jual</th>
                                <th class="text-right text-xs font-bold text-gray-500 uppercase tracking-wider pb-3 pr-4">Laba/Unit</th>
                                <th class="text-center text-xs font-bold text-gray-500 uppercase tracking-wider pb-3 pr-4">Profit (%)</th>
                                <th class="text-center text-xs font-bold text-gray-500 uppercase tracking-wider pb-3 pr-4">Terjual</th>
                                <th class="text-right text-xs font-bold text-gray-500 uppercase tracking-wider pb-3">Total Profit</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @php
                            $products = [
                                ['name'=>'Vintage Denim Jacket','brand'=>"Levi's",'modal'=>150000,'jual'=>250000,'terjual'=>5],
                                ['name'=>'Oversized Hoodie','brand'=>'Uniqlo','modal'=>200000,'jual'=>350000,'terjual'=>8],
                                ['name'=>'Cargo Pants','brand'=>'Dickies','modal'=>120000,'jual'=>200000,'terjual'=>6],
                                ['name'=>'Floral Dress','brand'=>'Zara','modal'=>180000,'jual'=>300000,'terjual'=>3],
                                ['name'=>'Classic White Tee','brand'=>'H&M','modal'=>50000,'jual'=>100000,'terjual'=>15],
                                ['name'=>'Leather Bomber Jacket','brand'=>'Zara','modal'=>300000,'jual'=>500000,'terjual'=>2],
                                ['name'=>'Striped Polo Shirt','brand'=>'Ralph Lauren','modal'=>80000,'jual'=>150000,'terjual'=>4],
                                ['name'=>'Knit Sweater','brand'=>'Uniqlo','modal'=>150000,'jual'=>250000,'terjual'=>7],
                                ['name'=>'PINK DRESS','brand'=>'Zara','modal'=>100000,'jual'=>100000,'terjual'=>0],
                            ];
                            @endphp
                            @foreach($products as $p)
                            @php
                                $laba = $p['jual'] - $p['modal'];
                                $persen = $p['modal'] > 0 ? round(($laba / $p['modal']) * 100, 1) : 0;
                                $totalProfit = $laba * $p['terjual'];
                                $isProfit = $laba > 0;
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 pr-4 font-medium text-gray-800">{{ $p['name'] }}</td>
                                <td class="py-3 pr-4 text-gray-500">{{ $p['brand'] }}</td>
                                <td class="py-3 pr-4 text-right text-gray-600">Rp {{ number_format($p['modal'], 0, ',', '.') }}</td>
                                <td class="py-3 pr-4 text-right font-medium text-blue-600">Rp {{ number_format($p['jual'], 0, ',', '.') }}</td>
                                <td class="py-3 pr-4 text-right {{ $isProfit ? 'text-green-600 font-semibold' : 'text-red-500' }}">
                                    Rp {{ number_format($laba, 0, ',', '.') }}
                                </td>
                                <td class="py-3 pr-4 text-center">
                                    <span class="inline-block px-2 py-0.5 rounded-md text-xs font-bold {{ $persen >= 50 ? 'bg-green-100 text-green-700' : ($persen > 0 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-600') }}">
                                        {{ $persen }}%
                                    </span>
                                </td>
                                <td class="py-3 pr-4 text-center text-gray-600">{{ $p['terjual'] }} pcs</td>
                                <td class="py-3 text-right font-bold {{ $totalProfit > 0 ? 'text-[#a855f7]' : 'text-gray-400' }}">
                                    Rp {{ number_format($totalProfit, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ===== Aktivitas Terbaru ===== -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-5 flex items-center gap-2">
                    <svg class="h-5 w-5 text-[#a855f7]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Aktivitas Terbaru
                </h2>
                <div class="space-y-1">
                    @php
                    $activities = [
                        ['desc'=>'PINK DRESS ditambahkan ke inventory','date'=>'18 Desember 2025','type'=>'add'],
                        ['desc'=>'Stok Oversized Hoodie ditambahkan (+3 pcs)','date'=>'18 Desember 2025','type'=>'add'],
                        ['desc'=>'Oversized Hoodie terjual (1 pcs)','date'=>'13 Desember 2025','type'=>'sell'],
                        ['desc'=>'Knit Sweater ditambahkan ke inventory','date'=>'13 Desember 2025','type'=>'add'],
                        ['desc'=>'Classic White Tee terjual (2 pcs)','date'=>'12 Desember 2025','type'=>'sell'],
                        ['desc'=>'Leather Bomber Jacket terjual (1 pcs)','date'=>'10 Desember 2025','type'=>'sell'],
                        ['desc'=>'Striped Polo Shirt ditambahkan ke inventory','date'=>'9 Desember 2025','type'=>'add'],
                    ];
                    @endphp
                    @foreach($activities as $act)
                    <div class="flex items-start gap-4 py-3 border-b border-gray-50 last:border-0">
                        <div class="mt-1.5 w-2.5 h-2.5 rounded-full flex-shrink-0 {{ $act['type']==='add' ? 'bg-blue-400' : 'bg-green-400' }}"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $act['desc'] }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $act['date'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
        <!-- ========================= -->
        <!-- END PAGE: DASHBOARD       -->
        <!-- ========================= -->


        <!-- ========================= -->
        <!-- OTHER PAGES (placeholder) -->
        <!-- ========================= -->
        <div x-show="page === 'produk'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Manajemen Produk</h1>
            <p class="text-gray-500 mb-6">Kelola semua produk inventory Anda</p>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center text-gray-400">
                <svg class="h-14 w-14 mx-auto mb-4 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <p class="font-medium">Halaman Manajemen Produk</p>
                <p class="text-sm mt-1">Konten akan ditampilkan di sini</p>
            </div>
        </div>

        <div x-show="page === 'stokmasuk'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Stok Masuk</h1>
            <p class="text-gray-500 mb-6">Pencatatan barang masuk ke inventory</p>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center text-gray-400">
                <svg class="h-14 w-14 mx-auto mb-4 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <p class="font-medium">Halaman Stok Masuk</p>
                <p class="text-sm mt-1">Konten akan ditampilkan di sini</p>
            </div>
        </div>

        <div x-show="page === 'stokkeluar'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Stok Keluar</h1>
            <p class="text-gray-500 mb-6">Pencatatan barang keluar dari inventory</p>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center text-gray-400">
                <svg class="h-14 w-14 mx-auto mb-4 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                </svg>
                <p class="font-medium">Halaman Stok Keluar</p>
                <p class="text-sm mt-1">Konten akan ditampilkan di sini</p>
            </div>
        </div>

        <div x-show="page === 'aktivitas'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Riwayat &amp; Aktivitas</h1>
            <p class="text-gray-500 mb-6">Log semua aktivitas sistem</p>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center text-gray-400">
                <svg class="h-14 w-14 mx-auto mb-4 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="font-medium">Halaman Riwayat &amp; Aktivitas</p>
                <p class="text-sm mt-1">Konten akan ditampilkan di sini</p>
            </div>
        </div>

        <div x-show="page === 'laporan'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Laporan Penjualan</h1>
            <p class="text-gray-500 mb-6">Ringkasan dan analisis penjualan</p>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center text-gray-400">
                <svg class="h-14 w-14 mx-auto mb-4 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="font-medium">Halaman Laporan Penjualan</p>
                <p class="text-sm mt-1">Konten akan ditampilkan di sini</p>
            </div>
        </div>

        <div x-show="page === 'customer'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Kelola Customer</h1>
            <p class="text-gray-500 mb-6">Data dan manajemen pelanggan</p>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center text-gray-400">
                <svg class="h-14 w-14 mx-auto mb-4 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <p class="font-medium">Halaman Kelola Customer</p>
                <p class="text-sm mt-1">Konten akan ditampilkan di sini</p>
            </div>
        </div>

        <div x-show="page === 'pengaturan'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Pengaturan</h1>
            <p class="text-gray-500 mb-6">Konfigurasi sistem dan akun</p>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center text-gray-400">
                <svg class="h-14 w-14 mx-auto mb-4 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <p class="font-medium">Halaman Pengaturan</p>
                <p class="text-sm mt-1">Konten akan ditampilkan di sini</p>
            </div>
        </div>

    </main>
    <!-- ===== END MAIN CONTENT ===== -->

</div>

<script>
// Grafik Penjualan 7 Hari Terakhir
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('salesChart');
    if (!ctx) return;

    const labels = ['15 Apr', '16 Apr', '17 Apr', '18 Apr', '19 Apr', '20 Apr', '21 Apr'];
    const data = [0, 2, 1, 3, 1, 4, 2];

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Penjualan',
                data: data,
                borderColor: '#a855f7',
                backgroundColor: 'rgba(168, 85, 247, 0.08)',
                borderWidth: 2.5,
                pointBackgroundColor: '#a855f7',
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.35,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e1b4b',
                    titleColor: '#c4b5fd',
                    bodyColor: '#fff',
                    padding: 10,
                    callbacks: {
                        label: (ctx) => ` ${ctx.parsed.y} pcs terjual`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, color: '#9ca3af', font: { family: 'Inter', size: 11 } },
                    grid: { color: '#f3f4f6' }
                },
                x: {
                    ticks: { color: '#9ca3af', font: { family: 'Inter', size: 11 } },
                    grid: { display: false }
                }
            }
        }
    });
});
</script>

</body>
</html>
