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
<body class="bg-gray-50 min-h-screen" x-data="adminApp()">

<div class="flex min-h-screen">

    @if (session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition.opacity.duration.500ms class="fixed top-6 left-1/2 transform -translate-x-1/2 z-[100] bg-white border border-green-200 text-green-700 px-5 py-2.5 rounded-full shadow-lg shadow-green-500/10 flex items-center gap-3 text-sm min-w-max justify-between" role="alert">
        <div class="flex items-center gap-2.5">
            <div class="bg-green-100 rounded-full p-1">
                <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span class="font-semibold whitespace-nowrap pr-2">{{ session('success') }}</span>
        </div>
        <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition focus:outline-none flex-shrink-0">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

    @if (session('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition.opacity.duration.500ms class="fixed top-6 left-1/2 transform -translate-x-1/2 z-[100] bg-white border border-red-200 text-red-700 px-5 py-2.5 rounded-full shadow-lg shadow-red-500/10 flex items-center gap-3 text-sm min-w-max justify-between" role="alert">
        <div class="flex items-center gap-2.5">
            <div class="bg-red-100 rounded-full p-1">
                <svg class="w-4 h-4 text-red-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="font-semibold whitespace-nowrap pr-2">{{ session('error') }}</span>
        </div>
        <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition focus:outline-none flex-shrink-0">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

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
                Kelola Pesanan
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
                            <p class="text-4xl font-bold text-gray-900 mt-2">{{ $totalTerjual }}</p>
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
                            <p class="text-3xl font-bold text-gray-900 mt-2">Rp {{ number_format($totalProfit, 0, ',', '.') }}</p>
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
                    <p class="text-3xl font-bold">Rp {{ number_format($totalModal, 0, ',', '.') }}</p>
                </div>
                <div class="profit-card" style="background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);">
                    <p class="text-sm font-medium text-green-100 mb-1 flex items-center gap-1">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        Total Pendapatan
                    </p>
                    <p class="text-3xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
                <div class="profit-card" style="background: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%);">
                    <p class="text-sm font-medium text-purple-100 mb-1 flex items-center gap-1">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Total Profit
                    </p>
                    <p class="text-3xl font-bold">Rp {{ number_format($totalProfit, 0, ',', '.') }}</p>
                    <p class="text-sm text-purple-200 mt-1">({{ $totalModal > 0 ? round(($totalProfit / $totalModal) * 100, 1) : 0 }}%)</p>
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

                    @foreach($aktivitas as $act)
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
            
            <!-- Top Header & Button -->
            <div class="flex justify-between items-end mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-1">Manajemen Produk</h1>
                    <p class="text-gray-500 text-sm"><span x-text="products.length"></span> produk ditemukan</p>
                </div>
                <button @click="openAddModal" class="bg-gradient-to-r from-[#a855f7] to-[#3b82f6] text-white px-5 py-2.5 rounded-xl font-medium flex items-center gap-2 hover:opacity-90 transition shadow-sm">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Produk
                </button>
            </div>

            <!-- Filter & Pencarian -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-6">
                <h3 class="text-gray-700 font-medium mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#a855f7]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter & Pencarian
                </h3>
                <div class="flex flex-wrap gap-3">
                    <div class="flex-1 min-w-[150px]">
                        <input type="text" placeholder="Cari produk..." class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200">
                    </div>
                    <div class="w-40">
                        <select class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200 text-gray-600 bg-white">
                            <option>Semua Kategori</option>
                            <option>outer</option>
                            <option>hoodie</option>
                            <option>celana</option>
                            <option>dress</option>
                        </select>
                    </div>
                    <div class="w-36">
                        <select class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200 text-gray-600 bg-white">
                            <option>Semua Ukuran</option>
                            <option>S</option>
                            <option>M</option>
                            <option>L</option>
                            <option>XL</option>
                        </select>
                    </div>
                    <div class="w-36">
                        <select class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200 text-gray-600 bg-white">
                            <option>Semua Kondisi</option>
                            <option>new</option>
                            <option>second</option>
                        </select>
                    </div>
                    <div class="w-36">
                        <input type="text" placeholder="Brand..." class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200">
                    </div>
                    <div class="w-36">
                        <select class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200 text-gray-600 bg-white">
                            <option>Semua Status</option>
                            <option>Tersedia</option>
                            <option>Habis</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Data Table -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden mb-8">
                <div class="overflow-x-auto scrollbar-thin">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 font-bold text-[11px] uppercase tracking-wider">
                            <tr>
                                <th class="px-5 py-4">PRODUK</th>
                                <th class="px-5 py-4">KATEGORI</th>
                                <th class="px-5 py-4">UKURAN</th>
                                <th class="px-5 py-4">KONDISI</th>
                                <th class="px-5 py-4">BRAND</th>
                                <th class="px-5 py-4">WARNA</th>
                                <th class="px-5 py-4">MODAL</th>
                                <th class="px-5 py-4">HARGA JUAL</th>
                                <th class="px-5 py-4 text-center">STOK</th>
                                <th class="px-5 py-4">LOKASI</th>
                                <th class="px-5 py-4 text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <template x-for="(p, index) in products" :key="index">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-5 py-4 text-gray-800 font-medium whitespace-nowrap" x-text="p.name"></td>
                                <td class="px-5 py-4">
                                    <span class="inline-block px-2.5 py-1 text-[11px] rounded font-medium text-blue-600 bg-blue-100" x-text="p.cat"></span>
                                </td>
                                <td class="px-5 py-4 text-gray-700" x-text="p.size"></td>
                                <td class="px-5 py-4">
                                    <span :class="p.cond === 'second' ? 'text-yellow-700 bg-yellow-100' : 'text-green-700 bg-green-100'" 
                                          class="inline-block px-2.5 py-1 text-[11px] rounded font-medium capitalize" x-text="p.cond"></span>
                                </td>
                                <td class="px-5 py-4 text-gray-700" x-text="p.brand"></td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="w-3.5 h-3.5 rounded-full border border-gray-200" :class="p.colorHex"></span>
                                        <span class="text-gray-700" x-text="p.color"></span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-gray-600 whitespace-nowrap" x-html="formatCurrency(p.modal)">
                                </td>
                                <td class="px-5 py-4 text-gray-600 whitespace-nowrap" x-html="formatCurrency(p.jual)">
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <div class="inline-flex flex-col items-center justify-center px-2 py-0.5 bg-[#dcfce7] text-[#166534] text-xs font-bold rounded">
                                        <span x-text="p.stock"></span>
                                        <span class="font-normal text-[10px] leading-tight">pcs</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-gray-600 whitespace-nowrap" x-text="p.loc"></td>
                                <td class="px-5 py-4 text-center">
                                    <div class="flex items-center justify-center gap-4">
                                        <button @click="openEditModal(index)" class="text-blue-500 hover:text-blue-700 transition" title="Edit">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button @click="deleteProduct(index)" class="text-red-500 hover:text-red-700 transition" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Modal Tambah Produk -->
            <div x-show="showAddModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div x-show="showAddModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-40 transition-opacity" aria-hidden="true" @click="showAddModal = false"></div>
            
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
                    <div x-show="showAddModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                        <div class="bg-white px-8 pt-6 pb-2 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="text-xl font-bold text-gray-900" id="modal-title" x-text="isEditing ? 'Edit Produk' : 'Tambah Produk Baru'"></h3>
                            <button @click="showAddModal = false" class="text-gray-400 hover:text-gray-600 transition">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        <div class="px-8 py-6 max-h-[70vh] overflow-y-auto scrollbar-thin">
                            <form :action="isEditing ? '/admin/produk/' + products[editIndex].id + '/update' : '/admin/produk'" method="POST" class="space-y-4 w-full text-left">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Nama Produk</label>
                                    <input type="text" name="nama" x-model="newProduct.name" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200">
                                </div>
                                <div class="grid grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Kategori</label>
                                        <select name="kategori" x-model="newProduct.cat" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200 bg-white">
                                            <option>Baju</option>
                                            <option>outer</option>
                                            <option>hoodie</option>
                                            <option>celana</option>
                                            <option>dress</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Ukuran</label>
                                        <select name="ukuran" x-model="newProduct.size" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200 bg-white">
                                            <option>S</option>
                                            <option>M</option>
                                            <option>L</option>
                                            <option>XL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Kondisi</label>
                                        <select name="kondisi" x-model="newProduct.cond" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200 bg-white">
                                            <option>new</option>
                                            <option>second</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Brand</label>
                                        <input type="text" name="brand" x-model="newProduct.brand" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Warna</label>
                                        <div class="flex items-center gap-2">
                                            <input type="color" name="warna_hex" x-model="newProduct.color" class="h-[46px] w-[50px] p-1 border border-gray-200 rounded-lg bg-white cursor-pointer" title="Pilih warna">
                                            <input type="text" name="warna" x-model="newProduct.color" placeholder="#000000" class="flex-1 w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Harga Modal (Rp)</label>
                                        <input type="number" name="harga_modal" x-model="newProduct.modal" min="0" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Harga Jual (Rp)</label>
                                        <input type="number" name="harga" x-model="newProduct.jual" min="0" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200">
                                    </div>
                                    <div x-show="!isEditing">
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Kuantitas</label>
                                        <input type="number" name="stok" x-model="newProduct.stock" min="0" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Lokasi Penyimpanan</label>
                                    <div class="grid grid-cols-2 gap-5">
                                        <input type="text" name="lokasi" x-model="newProduct.loc" placeholder="Box A - Rak 1" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200">
                                    </div>
                                </div>
                        </div>
                        <div class="bg-gray-50/50 px-8 py-5 border-t border-gray-100 flex justify-between gap-4">
                            <button type="button" @click="showAddModal = false" class="flex-1 bg-white border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl font-medium hover:bg-gray-50 transition shadow-sm">
                                Batal
                            </button>
                            <button type="submit" class="flex-1 bg-gradient-to-r from-[#8b5cf6] to-[#3b82f6] text-white px-4 py-2.5 rounded-xl font-medium hover:opacity-90 transition shadow-sm shadow-blue-500/20" x-text="isEditing ? 'Simpan Perubahan' : 'Tambah Produk'">
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div x-show="page === 'stokmasuk'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-1">Stok Masuk</h1>
                <p class="text-gray-500 text-sm">Pencatatan barang masuk ke inventory</p>
            </div>
        
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                <!-- Left Side: Form -->
                <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-6 self-start">
                    <h3 class="text-gray-800 font-bold mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#a855f7]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Input Stok Masuk
                    </h3>
                    
                    <form method="POST" action="/admin/stok-masuk" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Pilih Produk</label>
                            <select name="id_produk" x-model="stockForm.productId" required class="w-full border border-purple-300 rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-purple-200 bg-white shadow-sm">
                                <option value="">-- Pilih Produk --</option>
                                <template x-for="(p, index) in products" :key="index">
                                    <option :value="p.id" x-text="p.name"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Jumlah Stok Masuk</label>
                            <input type="number" name="kuantitas" x-model.number="stockForm.qty" min="1" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Lokasi Penyimpanan</label>
                            <input type="text" name="lokasi" x-model="stockForm.loc" placeholder="Box A, Rak 2, dll" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200">
                            <p class="text-xs text-gray-400 mt-1">Opsional - kosongkan untuk menggunakan lokasi default produk</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Catatan</label>
                            <textarea name="catatan" x-model="stockForm.note" placeholder="Catatan tambahan..." rows="3" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-purple-400 focus:ring-1 focus:ring-purple-200"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-[#8b5cf6] to-[#3b82f6] text-white py-3 rounded-lg font-medium hover:opacity-90 transition shadow-sm mt-4 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Tambah Stok
                        </button>
                    </form>
                </div>
        
                <!-- Right Side: Log Table -->
                <div class="lg:col-span-3 bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden self-start">
                    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                            Riwayat Stok Masuk
                        </h3>
                    </div>
                    <div class="overflow-x-auto scrollbar-thin">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-500 font-bold text-[11px] uppercase tracking-wider">
                                <tr>
                                    <th class="px-5 py-3">Waktu</th>
                                    <th class="px-5 py-3">Produk</th>
                                    <th class="px-5 py-3 text-center">Jumlah</th>
                                    <th class="px-5 py-3">Lokasi</th>
                                    <th class="px-5 py-3">Catatan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <template x-for="(log, idx) in stockLogs" :key="idx">
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-5 py-3 text-[11px] text-gray-500 whitespace-nowrap" x-text="log.date"></td>
                                        <td class="px-5 py-3 font-medium text-gray-800" x-text="log.productName"></td>
                                        <td class="px-5 py-3 text-center">
                                            <span class="inline-block px-2 py-0.5 bg-green-100 text-green-700 text-xs font-bold rounded" x-text="'+' + log.qty + ' pcs'"></span>
                                        </td>
                                        <td class="px-5 py-3 text-gray-600 text-xs" x-text="log.loc"></td>
                                        <td class="px-5 py-3 text-gray-500 italic text-[11px]" x-text="log.note || '-'"></td>
                                    </tr>
                                </template>
                                <tr x-show="stockLogs.length === 0">
                                    <td colspan="5" class="px-5 py-10 text-center text-gray-400">Belum ada riwayat stok masuk.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="page === 'stokkeluar'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-1">Stok Keluar</h1>
                <p class="text-gray-500 text-sm">Pencatatan barang keluar dari inventory</p>
            </div>
        
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                <!-- Left Side: Form -->
                <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-6 self-start">
                    <h3 class="text-gray-800 font-bold mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#ef4444]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Input Stok Keluar
                    </h3>
                    
                    <form method="POST" action="/admin/stok-keluar" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Pilih Produk</label>
                            <select name="id_produk" x-model="stockOutForm.productId" required class="w-full border border-red-300 rounded-lg px-4 py-2.5 outline-none focus:ring-2 focus:ring-red-200 bg-white shadow-sm">
                                <option value="">-- Pilih Produk --</option>
                                <template x-for="(p, index) in products" :key="index">
                                    <option :value="p.id" x-text="p.name + ' (Sisa: ' + p.stock + ')'"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Jumlah Stok Keluar</label>
                            <input type="number" name="kuantitas" x-model.number="stockOutForm.qty" min="1" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-red-400 focus:ring-1 focus:ring-red-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Alasan Keluar</label>
                            <select name="alasan" x-model="stockOutForm.reason" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-red-400 focus:ring-1 focus:ring-red-200 bg-white">
                                <option value="Terjual">Terjual</option>
                                <option value="Rusak">Rusak / Cacat</option>
                                <option value="Hilang">Hilang</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Catatan</label>
                            <textarea name="catatan" x-model="stockOutForm.note" placeholder="Catatan tambahan (Misal: Terjual di Shopee)..." rows="3" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-red-400 focus:ring-1 focus:ring-red-200"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-[#ef4444] to-[#f97316] text-white py-3 rounded-lg font-medium hover:opacity-90 transition shadow-sm mt-4 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4m8-8l-8 8 8 8"/></svg>
                            Kurangi Stok
                        </button>
                    </form>
                </div>
        
                <!-- Right Side: Log Table -->
                <div class="lg:col-span-3 bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden self-start">
                    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Riwayat Stok Keluar
                        </h3>
                    </div>
                    <div class="overflow-x-auto scrollbar-thin">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-500 font-bold text-[11px] uppercase tracking-wider">
                                <tr>
                                    <th class="px-5 py-3">Waktu</th>
                                    <th class="px-5 py-3">Produk</th>
                                    <th class="px-5 py-3 text-center">Jumlah</th>
                                    <th class="px-5 py-3">Alasan</th>
                                    <th class="px-5 py-3">Catatan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <template x-for="(log, idx) in stockOutLogs" :key="idx">
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-5 py-3 text-[11px] text-gray-500 whitespace-nowrap" x-text="log.date"></td>
                                        <td class="px-5 py-3 font-medium text-gray-800" x-text="log.productName"></td>
                                        <td class="px-5 py-3 text-center">
                                            <span class="inline-block px-2 py-0.5 bg-red-100 text-red-700 text-xs font-bold rounded" x-text="'-' + log.qty + ' pcs'"></span>
                                        </td>
                                        <td class="px-5 py-3">
                                            <span class="inline-block px-2 py-0.5 border border-gray-200 text-gray-600 text-[10px] uppercase font-bold rounded bg-white" x-text="log.reason"></span>
                                        </td>
                                        <td class="px-5 py-3 text-gray-500 italic text-[11px]" x-text="log.note || '-'"></td>
                                    </tr>
                                </template>
                                <tr x-show="stockOutLogs.length === 0">
                                    <td colspan="5" class="px-5 py-10 text-center text-gray-400">Belum ada riwayat stok keluar.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="page === 'aktivitas'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-1">Riwayat &amp; Aktivitas</h1>
                <p class="text-gray-500 text-sm" x-text="activityGroups.reduce((acc, curr) => acc + curr.items.length, 0) + ' aktivitas tercatat'"></p>
            </div>
            
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Add Card -->
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 flex flex-col justify-between">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span class="text-sm font-semibold text-blue-600 font-medium">Ditambahkan</span>
                    </div>
                    <p class="text-3xl font-bold text-blue-700" x-text="activitySummary.added"></p>
                </div>
                <!-- Edit Card -->
                <div class="bg-[#fefce8] border border-[#fef08a] rounded-xl p-5 flex flex-col justify-between">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span class="text-sm font-semibold text-yellow-700 font-medium">Diedit</span>
                    </div>
                    <p class="text-3xl font-bold text-yellow-800" x-text="activitySummary.edited"></p>
                </div>
                <!-- Sell Card -->
                <div class="bg-[#dcfce7] border border-[#bbf7d0] rounded-xl p-5 flex flex-col justify-between">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="text-sm font-semibold text-green-700 font-medium">Terjual</span>
                    </div>
                    <p class="text-3xl font-bold text-green-800" x-text="activitySummary.sold"></p>
                </div>
                <!-- Price Change Card -->
                <div class="bg-purple-50 border border-purple-100 rounded-xl p-5 flex flex-col justify-between">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm font-semibold text-purple-700 font-medium">Harga Diubah</span>
                    </div>
                    <p class="text-3xl font-bold text-purple-800" x-text="activitySummary.priceChanged"></p>
                </div>
            </div>

            <!-- Timeline Board -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-6 h-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Timeline Aktivitas
                    </h3>
                </div>
                
                <div class="p-8 space-y-10 border-t border-gray-50/50">
                    <template x-for="(group, groupIdx) in activityGroups" :key="groupIdx">
                        <div>
                            <!-- Date divider -->
                            <div class="flex items-center justify-center my-4 relative">
                                <span class="h-[1px] bg-gray-200 absolute w-full z-0"></span>
                                <span class="bg-white px-4 text-sm font-semibold text-gray-500 z-10" x-text="group.date"></span>
                            </div>
                            
                            <!-- Activity Items -->
                            <div class="space-y-4 mt-6">
                                <template x-for="(item, itemIdx) in group.items" :key="itemIdx">
                                    <div class="flex items-start gap-4 p-5 bg-gray-50/50 hover:bg-gray-50 transition border border-gray-100/50 rounded-xl">
                                        <!-- Icon -->
                                        <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center" 
                                            :class="{
                                                'bg-blue-100 text-blue-600': item.color === 'blue',
                                                'bg-yellow-100 text-yellow-600': item.color === 'yellow',
                                                'bg-green-100 text-green-600': item.color === 'green',
                                                'bg-purple-100 text-purple-600': item.color === 'purple'
                                            }">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" :d="item.icon"/>
                                            </svg>
                                        </div>
                                        
                                        <!-- Content -->
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="inline-block px-2.5 py-1 text-[11px] rounded font-bold uppercase tracking-wider"
                                                    :class="{
                                                        'bg-blue-100 text-blue-700': item.color === 'blue',
                                                        'bg-yellow-100 text-yellow-700': item.color === 'yellow',
                                                        'bg-green-100 text-green-700': item.color === 'green',
                                                        'bg-purple-100 text-purple-700': item.color === 'purple'
                                                    }" x-text="item.label"></span>
                                                <span class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider" x-text="item.time"></span>
                                                <span class="text-xs font-semibold text-gray-400">&bull;</span>
                                                <span class="text-xs font-medium text-gray-500" x-text="item.product"></span>
                                            </div>
                                            <p class="text-[15px] font-medium text-gray-800" x-text="item.desc"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div x-show="page === 'laporan'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-1">Laporan Penjualan</h1>
                <p class="text-gray-500 text-sm">Analisis lengkap performa penjualan</p>
            </div>
            
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Total Barang Terjual Card -->
                <div class="bg-white border border-gray-100 rounded-xl p-5 flex flex-col justify-between shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded bg-blue-50 text-blue-500 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-500">Total Barang Terjual</span>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-800" x-text="totalSoldItems"></p>
                        <span class="text-xs text-gray-400 font-medium">pcs</span>
                    </div>
                </div>
                <!-- Total Modal Card -->
                <div class="bg-white border border-gray-100 rounded-xl p-5 flex flex-col justify-between shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                         <div class="w-8 h-8 rounded bg-yellow-50 text-yellow-500 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-500">Total Modal</span>
                    </div>
                    <p class="text-2xl font-bold text-gray-800" x-text="formatCurrency(totalModal).replace('<br>', ' ')"></p>
                </div>
                <!-- Total Pendapatan Card -->
                <div class="bg-white border border-gray-100 rounded-xl p-5 flex flex-col justify-between shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded bg-green-50 text-green-500 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-500">Total Pendapatan</span>
                    </div>
                    <p class="text-2xl font-bold text-gray-800" x-text="formatCurrency(totalRevenue).replace('<br>', ' ')"></p>
                </div>
                <!-- Total Profit Card -->
                <div class="bg-white border border-gray-100 rounded-xl p-5 flex flex-col justify-between shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded bg-purple-50 text-purple-500 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-500">Total Profit</span>
                    </div>
                    <p class="text-2xl font-bold text-purple-600" x-text="formatCurrency(totalProfit).replace('<br>', ' ')"></p>
                </div>
            </div>

            <!-- Full Width Chart -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 mb-8 w-full">
                <h3 class="font-bold text-gray-800 mb-6">Brand Paling Laku</h3>
                <div class="relative h-64 w-full">
                    <canvas id="brandBarChart"></canvas>
                </div>
            </div>

            <!-- Table Riwayat Laporan Penjualan -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Daftar Transaksi Penjualan
                    </h3>
                </div>
                <div class="overflow-x-auto scrollbar-thin">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 font-bold text-[11px] uppercase tracking-wider">
                            <tr>
                                <th class="px-5 py-3">Waktu</th>
                                <th class="px-5 py-3">Produk</th>
                                <th class="px-5 py-3 text-center">Brand</th>
                                <th class="px-5 py-3 text-center">Qty</th>
                                <th class="px-5 py-3 text-right">Harga Satuan</th>
                                <th class="px-5 py-3 text-right">Total Modal</th>
                                <th class="px-5 py-3 text-right">Total Pendapatan</th>
                                <th class="px-5 py-3 text-right">Net Profit</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <template x-for="(sale, idx) in salesLogs" :key="idx">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-5 py-3 text-[11px] text-gray-500 whitespace-nowrap" x-text="sale.date"></td>
                                    <td class="px-5 py-3 font-medium text-gray-800" x-text="sale.productName"></td>
                                    <td class="px-5 py-3 text-center">
                                        <span class="text-xs bg-gray-100 text-gray-600 px-2 flex items-center justify-center font-semibold rounded mx-auto uppercase py-0.5" style="max-width: fit-content;" x-text="sale.brand"></span>
                                    </td>
                                    <td class="px-5 py-3 text-center">
                                        <span class="inline-block px-2 py-0.5 bg-green-100 text-green-700 text-xs font-bold rounded" x-text="sale.qty + ' pcs'"></span>
                                    </td>
                                    <td class="px-5 py-3 text-right text-gray-600 font-medium" x-text="formatCurrency(sale.harga).replace('<br>','')"></td>
                                    <td class="px-5 py-3 text-right text-yellow-600 font-medium opacity-80" x-text="formatCurrency(sale.modalTotal).replace('<br>','')"></td>
                                    <td class="px-5 py-3 text-right text-green-600 font-bold" x-text="formatCurrency(sale.revenueTotal).replace('<br>','')"></td>
                                    <td class="px-5 py-3 text-right text-purple-600 font-bold bg-purple-50/30" x-text="formatCurrency(sale.profitTotal).replace('<br>','')"></td>
                                </tr>
                            </template>
                            <tr x-show="salesLogs.length === 0">
                                <td colspan="8" class="px-5 py-10 text-center text-gray-400">Belum ada transaksi penjualan tercatat.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div x-show="page === 'customer'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Pesanan Customer</h1>
            <p class="text-gray-500 mb-6">Kelola dan update status pesanan</p>
            
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto scrollbar-thin">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 font-bold text-[11px] uppercase tracking-wider border-b border-gray-100">
                            <tr>
                                <th class="px-5 py-4">Order ID</th>
                                <th class="px-5 py-4">Customer</th>
                                <th class="px-5 py-4 text-center">Items</th>
                                <th class="px-5 py-4">Total</th>
                                <th class="px-5 py-4 text-center">Pembayaran</th>
                                <th class="px-5 py-4 text-center">Status</th>
                                <th class="px-5 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <template x-for="order in customerOrders" :key="order.id">
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-5 py-4 font-bold text-gray-800" x-text="order.order_id"></td>
                                    <td class="px-5 py-4">
                                        <div class="font-medium text-gray-800" x-text="order.customer"></div>
                                        <div class="text-xs text-gray-500 mt-0.5" x-text="order.phone"></div>
                                    </td>
                                    <td class="px-5 py-4 text-center text-gray-600" x-text="order.items_count + ' item(s)'"></td>
                                    <td class="px-5 py-4 font-medium text-gray-800" x-text="formatCurrency(order.total).replace('<br>',' ')"></td>
                                    <td class="px-5 py-4 text-center">
                                        <span class="px-2.5 py-1 text-[11px] font-bold rounded text-blue-700 bg-blue-100 lowercase" x-text="order.payment"></span>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded"
                                            :class="{
                                                'bg-yellow-100 text-yellow-700': order.status.toLowerCase() === 'pending',
                                                'bg-blue-100 text-blue-700': order.status.toLowerCase() === 'dikemas',
                                                'bg-purple-100 text-purple-700': order.status.toLowerCase() === 'dikirim',
                                                'bg-green-100 text-green-700': order.status.toLowerCase() === 'selesai',
                                                'bg-red-100 text-red-700': order.status.toLowerCase() === 'dibatalkan',
                                                'bg-gray-100 text-gray-700': !['pending','dikemas','dikirim','selesai','dibatalkan'].includes(order.status.toLowerCase())
                                            }" x-text="order.status.charAt(0).toUpperCase() + order.status.slice(1)">
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <form method="POST" :action="'/admin/pesanan/' + order.id + '/status'" class="inline-block">
                                            @csrf
                                            <select name="status_pesanan" onchange="this.form.submit()" class="border border-gray-200 rounded-lg text-sm px-3 py-1.5 focus:ring-1 focus:ring-blue-500 outline-none cursor-pointer bg-white">
                                                <option value="Pending" :selected="order.status.toLowerCase() === 'pending'">Pending</option>
                                                <option value="Dikemas" :selected="order.status.toLowerCase() === 'dikemas'">Dikemas</option>
                                                <option value="Dikirim" :selected="order.status.toLowerCase() === 'dikirim'">Dikirim</option>
                                                <option value="Selesai" :selected="order.status.toLowerCase() === 'selesai'">Selesai</option>
                                                <option value="Dibatalkan" :selected="order.status.toLowerCase() === 'dibatalkan'">Dibatalkan</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            </template>
                            <tr x-show="customerOrders.length === 0">
                                <td colspan="7" class="px-5 py-10 text-center text-gray-400">Belum ada pesanan masuk.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
document.addEventListener('alpine:init', () => {
    // Setup Waktu Realtime untuk Data Awal
    const n = new Date();
    const actDays = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const actMonths = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    const todayDateStr = actDays[n.getDay()] + ', ' + n.getDate() + ' ' + actMonths[n.getMonth()] + ' ' + n.getFullYear();
    const todayTimeStr = n.getHours().toString().padStart(2, '0') + ':' + n.getMinutes().toString().padStart(2, '0');
    const tableDateStr = n.getDate() + ' ' + actMonths[n.getMonth()].substring(0,3) + ' ' + n.getFullYear() + ' ' + todayTimeStr;

    Alpine.data('adminApp', () => ({
        page: new URLSearchParams(window.location.search).get('page') || 'dashboard',
        sidebarOpen: true,
        showAddModal: false,
        isEditing: false,
        editIndex: null,
        newProduct: { name: '', cat: 'Baju', size: 'M', cond: 'new', brand: '', color: '', modal: 0, jual: 0, stock: 0, loc: '' },
        products: @json($products ?? []),
        formatCurrency(val) {
            return 'Rp<br>' + new Intl.NumberFormat('id-ID').format(val);
        },
        openAddModal() {
            this.isEditing = false;
            this.editIndex = null;
            this.newProduct = { name: '', cat: 'Baju', size: 'M', cond: 'new', brand: '', color: '', modal: 0, jual: 0, stock: 0, loc: '' };
            this.showAddModal = true;
        },
        openEditModal(index) {
            this.isEditing = true;
            this.editIndex = index;
            // JSON parse stringify used for a quick deep clone
            this.newProduct = JSON.parse(JSON.stringify(this.products[index]));
            this.showAddModal = true;
        },
        deleteProduct(index) {
            const prod = this.products[index];
            this.logActivity('delete', prod.name, `Produk ${prod.name} beserta seluruh sisa stoknya telah dihapus`);
            this.products.splice(index, 1);
        },
        saveProduct() {
            if (!this.newProduct.name) return;
            
            const pData = {
                name: this.newProduct.name,
                cat: this.newProduct.cat,
                size: this.newProduct.size,
                cond: this.newProduct.cond,
                brand: this.newProduct.brand,
                color: this.newProduct.color,
                colorHex: this.newProduct.colorHex || 'bg-gray-400', 
                modal: parseInt(this.newProduct.modal) || 0,
                jual: parseInt(this.newProduct.jual) || 0,
                stock: parseInt(this.newProduct.stock) || 0,
                loc: this.newProduct.loc
            };

            if (this.isEditing && this.editIndex !== null) {
                const oldProduct = this.products[this.editIndex];
                if (oldProduct.jual !== pData.jual) {
                    this.logActivity('price', pData.name, `Harga jual diperbarui dari Rp ${new Intl.NumberFormat('id-ID').format(oldProduct.jual)} menjadi Rp ${new Intl.NumberFormat('id-ID').format(pData.jual)}`);
                }
                this.logActivity('edit', pData.name, `Informasi produk ${pData.name} diperbarui oleh entri lokal`);
                
                this.products[this.editIndex] = pData;
            } else {
                this.products.unshift(pData);
                this.logActivity('add', pData.name, `${pData.name} berhasil didaftarkan ke inventory dengan stok awal ${pData.stock} pcs`);
            }
            
            this.showAddModal = false;
        },
        
        // --- Logic Stok Masuk ---
        stockForm: { productId: '', qty: 0, loc: '', note: '' },
        stockLogs: @json($stokMasuk ?? []),
        addStockEntry() {
            if (this.stockForm.productId === '' || !this.stockForm.qty) return;
            
            const product = this.products[this.stockForm.productId];
            const addedQty = parseInt(this.stockForm.qty);
            
            // Format waktu saat ini
            const now = new Date();
            const dateString = now.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) + ' ' + 
                               now.getHours().toString().padStart(2, '0') + ':' + 
                               now.getMinutes().toString().padStart(2, '0');
            
            // Tentukan lokasi (bisa pakai dari produk jika dikosongkan)
            const finalLoc = this.stockForm.loc ? this.stockForm.loc : product.loc;
            
            // Masukkan ke log
            this.stockLogs.unshift({
                date: dateString,
                productName: product.name,
                qty: addedQty,
                loc: finalLoc,
                note: this.stockForm.note
            });
            
            // Tambahkan stok ke array produk
            product.stock += addedQty;
            
            // Opsional: perbarui lokasi jika diberikan info baru
            if (this.stockForm.loc) {
                product.loc = this.stockForm.loc;
            }
            
            // Reset form
            this.stockForm = { productId: '', qty: 0, loc: '', note: '' };
            this.logActivity('stock_in', product.name, `Stok bertambah (+${addedQty} pcs). ${this.stockForm.note ? 'Catatan: ' + this.stockForm.note : ''}`);
            
            // Optional: Munculkan notikasi toast (Jika ada)
            alert('Stok '+product.name+' berhasil ditambahkan sebanyak '+addedQty+' pcs!');
        },
        
        // --- Logic Stok Keluar ---
        stockOutForm: { productId: '', qty: 0, reason: 'Terjual', note: '' },
        stockOutLogs: @json($stokKeluar ?? []),
        addStockOutEntry() {
            if (this.stockOutForm.productId === '' || !this.stockOutForm.qty) return;
            
            const product = this.products[this.stockOutForm.productId];
            const removedQty = parseInt(this.stockOutForm.qty);
            
            if (removedQty > product.stock) {
                alert('Peringatan: Stok tidak mencukupi! Sisa stok ' + product.name + ' hanya ' + product.stock + ' pcs.');
                return;
            }
            
            // Format waktu saat ini
            const now = new Date();
            const dateString = now.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) + ' ' + 
                               now.getHours().toString().padStart(2, '0') + ':' + 
                               now.getMinutes().toString().padStart(2, '0');
            
            // Masukkan ke log
            this.stockOutLogs.unshift({
                date: dateString,
                productName: product.name,
                qty: removedQty,
                reason: this.stockOutForm.reason,
                note: this.stockOutForm.note
            });
            
            // Kurangi stok di array produk
            product.stock -= removedQty;
            
            if (this.stockOutForm.reason === 'Terjual') {
                this.logActivity('sell', product.name, `Terjual ${removedQty} pcs${this.stockOutForm.note ? ' via '+this.stockOutForm.note : ''}`);
                
                // --- Insert into Sales Log ---
                const modalTot = product.modal * removedQty;
                const revTot = product.jual * removedQty;
                
                this.salesLogs.unshift({
                    date: dateString,
                    productName: product.name,
                    brand: product.brand || 'No Brand',
                    qty: removedQty,
                    harga: product.jual,
                    modalTotal: modalTot,
                    revenueTotal: revTot,
                    profitTotal: revTot - modalTot
                });
                
                // Update chart
                this.updateBrandChart();
            } else {
                this.logActivity('out', product.name, `Keluar ${removedQty} pcs karena ${this.stockOutForm.reason}.${this.stockOutForm.note ? ' Catatan: '+this.stockOutForm.note : ''}`);
            }

            // Reset form
            this.stockOutForm = { productId: '', qty: 0, reason: 'Terjual', note: '' };
            
            // Optional: Munculkan notikasi toast (Jika ada)
            alert('Stok '+product.name+' berhasil dikurangi sebanyak '+removedQty+' pcs!');
        },
        
        // --- Logic Aktivitas ---
        logActivity(type, product, desc) {
            let label = "";
            let color = "blue";
            let icon = "M12 4v16m8-8H4";

            if (type === 'add') {
                label = "Ditambahkan"; color = "blue"; this.activitySummary.added++;
                icon = "M12 4v16m8-8H4";
            } else if (type === 'edit') {
                label = "Diedit"; color = "yellow"; this.activitySummary.edited++;
                icon = "M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z";
            } else if (type === 'sell' || type === 'out') {
                label = type === 'sell' ? "Terjual" : "Barang Keluar"; 
                color = type === 'sell' ? "green" : "red"; 
                if (type === 'sell') this.activitySummary.sold++;
                icon = "M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z";
            } else if (type === 'price') {
                label = "Harga Diubah"; color = "purple"; this.activitySummary.priceChanged++;
                icon = "M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z";
            } else if (type === 'delete') {
                label = "Dihapus"; color = "red";
                icon = "M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16";
            } else if (type === 'stock_in') {
                label = "Stok Masuk"; color = "blue";
                icon = "M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4";    
            }

            // Get standard locale date for grouping
            const dateObj = new Date();
            const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            const dateStr = days[dateObj.getDay()] + ', ' + dateObj.getDate() + ' ' + months[dateObj.getMonth()] + ' ' + dateObj.getFullYear();
            const timeStr = dateObj.getHours().toString().padStart(2, '0') + ':' + dateObj.getMinutes().toString().padStart(2, '0');
            
            const newItem = { type, icon, color, label, product, desc, time: timeStr };

            let group = this.activityGroups.find(g => g.date === dateStr);
            if (group) {
                group.items.unshift(newItem);
            } else {
                this.activityGroups.unshift({ date: dateStr, items: [newItem] });
            }
        },
        
        activitySummary: {!! json_encode($activitySummary ?? ['added'=>0, 'edited'=>0, 'sold'=>0, 'priceChanged'=>0]) !!},
        activityGroups: {!! json_encode($activityGroups ?? []) !!},
        
        // --- Logic Laporan Penjualan ---
        salesLogs: {!! json_encode($salesLogs ?? []) !!},
        customerOrders: {!! json_encode($customerOrders ?? []) !!},
        
        init() {
            setTimeout(() => {
                this.updateBrandChart();
            }, 300);
        },
        
        get totalSoldItems() {
            return this.salesLogs.reduce((acc, sale) => acc + sale.qty, 0);
        },
        get totalModal() {
            return this.salesLogs.reduce((acc, sale) => acc + sale.modalTotal, 0);
        },
        get totalRevenue() {
            return this.salesLogs.reduce((acc, sale) => acc + sale.revenueTotal, 0);
        },
        get totalProfit() {
            return this.salesLogs.reduce((acc, sale) => acc + sale.profitTotal, 0);
        },
        
        updateBrandChart() {
            // Re-aggregate specific brands for the bar chart
            const brandSales = {};
            this.salesLogs.forEach(s => {
                if(!brandSales[s.brand]) brandSales[s.brand] = 0;
                brandSales[s.brand] += s.qty;
            });
            
            const labels = Object.keys(brandSales);
            const data = Object.values(brandSales);
            
            // Dispatch event to chart
            window.dispatchEvent(new CustomEvent('update-brand-chart', {
                detail: { labels, data }
            }));
        }
    }));
});

// Grafik Brand Paling Laku (Dynamic)
document.addEventListener('DOMContentLoaded', function () {
    const ctxBrand = document.getElementById('brandBarChart');
    if (!ctxBrand) return;

    let brandChart = new Chart(ctxBrand, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Barang Terjual',
                data: [],
                backgroundColor: '#8b5cf6', // purple-500 to match design
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#374151',
                    bodyColor: '#8b5cf6',
                    borderColor: '#f3f4f6',
                    borderWidth: 1,
                    padding: 10,
                    callbacks: {
                        label: (ctx) => ` Terjual : ${ctx.parsed.y} pcs`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 4, color: '#9ca3af', font: { family: 'Inter', size: 11 } },
                    grid: { color: '#f3f4f6' }
                },
                x: {
                    ticks: { color: '#9ca3af', font: { family: 'Inter', size: 11 } },
                    grid: { display: false }
                }
            }
        }
    });

    window.addEventListener('update-brand-chart', (e) => {
        brandChart.data.labels = e.detail.labels;
        brandChart.data.datasets[0].data = e.detail.data;
        brandChart.update();
    });
});


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
