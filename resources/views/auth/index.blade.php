<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitventory - Login & Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .bg-gradient-primary {
            background: linear-gradient(135deg, #a855f7 0%, #3b82f6 100%);
        }
        .bg-gradient-header {
            background: linear-gradient(90deg, #a855f7 0%, #3b82f6 100%);
        }
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-gradient-primary min-h-screen flex items-center justify-center p-4">

    <!-- Auth Card -->
    <div x-data="{ tab: '{{ old('name') || $errors->has('name') ? 'register' : 'login' }}', role: '{{ old('role', 'pelanggan') }}' }" class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden">
        
        <!-- Header Section -->
        <div class="bg-gradient-header py-10 px-6 text-center text-white">
            <h1 class="text-3xl font-bold mb-2">Fitventory</h1>
            <p class="text-sm font-medium text-white/80">Inventory Management System</p>
        </div>

        <!-- Form Section -->
        <div class="p-6 sm:p-8">
            
            <!-- Tabs -->
            <div class="flex bg-gray-100 p-1 rounded-xl mb-8">
                <button @click="tab = 'login'" 
                        :class="tab === 'login' ? 'bg-[#a855f7] text-white shadow-md' : 'text-gray-500 hover:text-gray-700'" 
                        class="flex-1 py-2.5 rounded-lg flex items-center justify-center gap-2 text-sm font-semibold transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Login
                </button>
                <button @click="tab = 'register'" 
                        :class="tab === 'register' ? 'bg-[#a855f7] text-white shadow-md' : 'text-gray-500 hover:text-gray-700'"
                        class="flex-1 py-2.5 rounded-lg flex items-center justify-center gap-2 text-sm font-semibold transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Register
                </button>
            </div>

            <!-- Login Form -->
            <form x-show="tab === 'login'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" action="/login" method="POST" class="space-y-5">
                @csrf
                
                <!-- Display Errors -->
                @if($errors->any() && !$errors->has('name'))
                    <div class="bg-red-50 text-red-500 p-3 rounded-lg text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#a855f7] focus:border-[#a855f7] outline-none transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#a855f7] focus:border-[#a855f7] outline-none transition-all" required>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-gradient-header hover:opacity-90 text-white font-semibold py-3 rounded-xl transition-opacity shadow-lg shadow-blue-500/30">
                        Masuk
                    </button>
                </div>
                
                <!-- Demo Accounts Info -->
                <div class="mt-6 bg-gray-50 rounded-xl p-4 text-xs text-gray-500 flex flex-col items-center">
                    <span class="font-semibold text-gray-600 mb-2">Demo Accounts (Tergantung Database):</span>
                    <div class="flex items-center gap-2 mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                        Admin: admin@fitventory.com
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" /></svg>
                        Pelanggan: user@fitventory.com
                    </div>
                </div>
            </form>

            <!-- Register Form -->
            <form x-show="tab === 'register'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;" action="/register" method="POST" class="space-y-5">
                @csrf

                <!-- Display Errors form Register -->
                @if($errors->any() && $errors->has('name'))
                    <div class="bg-red-50 text-red-500 p-3 rounded-lg text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#a855f7] focus:border-[#a855f7] outline-none transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#a855f7] focus:border-[#a855f7] outline-none transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#a855f7] focus:border-[#a855f7] outline-none transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Daftar Sebagai</label>
                    <div class="flex gap-4">
                        <input type="hidden" name="role" :value="role">
                        <button type="button" @click="role = 'admin'" :class="role === 'admin' ? 'border-[#a855f7] text-[#a855f7] ring-1 ring-[#a855f7]' : 'border-gray-200 text-gray-600 hover:bg-gray-50'" class="flex-1 py-2.5 border rounded-xl flex items-center justify-center gap-2 text-sm font-medium transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Admin
                        </button>
                        <button type="button" @click="role = 'pelanggan'" :class="role === 'pelanggan' ? 'border-[#a855f7] text-[#a855f7] ring-1 ring-[#a855f7]' : 'border-gray-200 text-gray-600 hover:bg-gray-50'" class="flex-1 py-2.5 border rounded-xl flex items-center justify-center gap-2 text-sm font-medium transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                            </svg>
                            Pelanggan
                        </button>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-gradient-header hover:opacity-90 text-white font-semibold py-3 rounded-xl transition-opacity shadow-lg shadow-blue-500/30">
                        Daftar Akun
                    </button>
                </div>
            </form>

        </div>
    </div>

</body>
</html>
