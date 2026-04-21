<!DOCTYPE html>
<html>
<head>
    <title>Fitventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- NAVBAR -->
<div class="bg-white shadow-md px-6 py-4 flex justify-between items-center">

    <!-- LOGO -->
    <h1 class="text-xl font-bold text-blue-600">
        Fitventory
    </h1>

    <!-- MENU -->
    <div class="space-x-6">
        <a href="/" class="text-gray-600 hover:text-blue-500">Home</a>
        <a href="/produk" class="text-gray-600 hover:text-blue-500">Produk</a>
        <a href="/tambah-produk" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Tambah
        </a>
    </div>

</div>

<!-- ISI HALAMAN -->
<div class="max-w-6xl mx-auto p-5">
    @yield('content')
</div>

</body>
</html>