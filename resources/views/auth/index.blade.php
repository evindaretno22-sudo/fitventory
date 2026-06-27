<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitventory - Login & Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
        .backdrop {
            backdrop-filter: blur(8px);
            background-color: rgba(0, 0, 0, 0.4);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 backdrop">

    <!-- Auth Card -->
    <div x-data="{ tab: '{{ old('name') || $errors->has('name') ? 'register' : 'login' }}', role: '{{ old('role', 'pelanggan') }}' }" 
         class="w-full max-w-[420px] bg-[#1e3a8a] rounded-[2.5rem] shadow-2xl overflow-hidden relative border-4 border-blue-900/50">
        
        <!-- Header Section (Dark Blue) -->
        <div class="pt-12 pb-20 px-6 text-center text-white flex flex-col items-center">
            <!-- Logo Placeholder (SVG similar to image) -->
            <div class="mb-4">
                <svg width="80" height="80" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Hanger/Shirt abstract icon -->
                    <path d="M50 20 C45 20 45 28 50 28 C55 28 55 20 50 20 Z" stroke="#2dd4bf" stroke-width="4"/>
                    <path d="M50 28 L50 40 L30 55 L30 65 L45 55 L45 80 L55 80 L55 55 L70 65 L70 55 L50 40" stroke="#38bdf8" stroke-width="4" stroke-linejoin="round"/>
                    <path d="M30 55 L20 60" stroke="#2dd4bf" stroke-width="4" stroke-linecap="round"/>
                    <path d="M70 55 L80 60" stroke="#2dd4bf" stroke-width="4" stroke-linecap="round"/>
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold mb-1 tracking-tight flex items-center gap-1">
                <span class="text-[#2dd4bf] italic">FIT</span><span class="text-white italic">VENTORY</span>
            </h1>
            
            <!-- Login Text -->
            <div x-show="tab === 'login'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="mt-4">
                <h2 class="text-xl font-bold mb-1">Selamat Datang Kembali!</h2>
                <p class="text-sm font-medium text-gray-300">Masuk ke akun Anda</p>
            </div>
            <!-- Register Text -->
            <div x-show="tab === 'register'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="mt-4" style="display: none;">
                <h2 class="text-xl font-bold mb-1">Buat Akun Baru</h2>
                <p class="text-sm font-medium text-gray-300">Daftar untuk memulai</p>
            </div>
        </div>

        <!-- Form Section (White Bottom Sheet) -->
        <div class="bg-white px-6 py-8 rounded-t-[2rem] -mt-10 relative z-10 min-h-[400px]">
            
            <!-- Login Form -->
            <form x-show="tab === 'login'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" action="/login" method="POST" class="space-y-4">
                @csrf
                
                @if($errors->any() && !$errors->has('name'))
                    <div class="bg-red-50 text-red-500 p-3 rounded-xl text-sm font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-regular fa-user text-gray-400"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan nama pengguna atau email..." class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2dd4bf] focus:border-[#2dd4bf] outline-none transition-all text-sm" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Kata Sandi</label>
                    <div class="relative" x-data="{ show: false }">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-400"></i>
                        </div>
                        <input :type="show ? 'text' : 'password'" name="password" placeholder="••••••••" class="w-full pl-10 pr-10 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2dd4bf] focus:border-[#2dd4bf] outline-none transition-all text-sm" required>
                        <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center cursor-pointer" @click="show = !show">
                            <i class="fa-regular text-gray-400 hover:text-gray-600 transition-colors" :class="show ? 'fa-eye' : 'fa-eye-slash'"></i>
                        </div>
                    </div>
                    <div class="flex justify-end mt-2">
                        <a href="#" class="text-xs font-semibold text-[#1e40af] hover:underline">Lupa dengan password?</a>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#22c55e] hover:bg-[#16a34a] text-white font-bold py-3.5 rounded-xl transition-colors shadow-lg shadow-green-500/20 text-sm">
                        MASUK
                    </button>
                </div>
                


                <div class="text-center mt-8 text-sm">
                    <span class="text-gray-600">Belum punya akun?</span> 
                    <button type="button" @click="tab = 'register'" class="font-bold text-[#1e40af] hover:underline">[Daftar Sekarang]</button>
                </div>
                
                <!-- Demo Accounts Info -->
                <div class="mt-6 bg-gray-50 rounded-xl p-3 text-[11px] text-gray-500 flex flex-col items-center">
                    <span class="font-semibold text-gray-600 mb-1">Demo Accounts:</span>
                    <div class="flex gap-4">
                        <span>Admin: admin@fitventory.com</span>
                        <span>User: user@fitventory.com</span>
                    </div>
                </div>
            </form>

            <!-- Register Form -->
            <form x-show="tab === 'register'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" action="/register" method="POST" class="space-y-4">
                @csrf

                @if($errors->any() && $errors->has('name'))
                    <div class="bg-red-50 text-red-500 p-3 rounded-xl text-sm font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif
                
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-regular fa-id-card text-gray-400"></i>
                        </div>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2dd4bf] focus:border-[#2dd4bf] outline-none transition-all text-sm" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-regular fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2dd4bf] focus:border-[#2dd4bf] outline-none transition-all text-sm" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Kata Sandi</label>
                    <div class="relative" x-data="{ show: false }">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-400"></i>
                        </div>
                        <input :type="show ? 'text' : 'password'" name="password" placeholder="••••••••" class="w-full pl-10 pr-10 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2dd4bf] focus:border-[#2dd4bf] outline-none transition-all text-sm" required>
                         <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center cursor-pointer" @click="show = !show">
                            <i class="fa-regular text-gray-400 hover:text-gray-600 transition-colors" :class="show ? 'fa-eye' : 'fa-eye-slash'"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Daftar Sebagai</label>
                    <div class="flex gap-3">
                        <input type="hidden" name="role" :value="role">
                        <button type="button" @click="role = 'admin'" :class="role === 'admin' ? 'bg-blue-50 border-[#1e40af] text-[#1e40af] ring-1 ring-[#1e40af]' : 'border-gray-200 text-gray-500 hover:bg-gray-50'" class="flex-1 py-2.5 border rounded-xl flex items-center justify-center gap-2 text-sm font-bold transition-all">
                            <i class="fa-solid fa-user-tie"></i>
                            Admin
                        </button>
                        <button type="button" @click="role = 'pelanggan'" :class="role === 'pelanggan' ? 'bg-blue-50 border-[#1e40af] text-[#1e40af] ring-1 ring-[#1e40af]' : 'border-gray-200 text-gray-500 hover:bg-gray-50'" class="flex-1 py-2.5 border rounded-xl flex items-center justify-center gap-2 text-sm font-bold transition-all">
                            <i class="fa-solid fa-user"></i>
                            Pelanggan
                        </button>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-[#22c55e] hover:bg-[#16a34a] text-white font-bold py-3.5 rounded-xl transition-colors shadow-lg shadow-green-500/20 text-sm">
                        DAFTAR SEKARANG
                    </button>
                </div>



                <div class="text-center mt-6 text-sm">
                    <span class="text-gray-600">Sudah punya akun?</span> 
                    <button type="button" @click="tab = 'login'" class="font-bold text-[#1e40af] hover:underline">[Masuk Sekarang]</button>
                </div>
            </form>

        </div>
    </div>

</body>
</html>
