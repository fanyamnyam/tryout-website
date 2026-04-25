<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Role - SDIT Al Iman</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white min-h-screen flex flex-col">

    <header class="w-full py-5 px-10 border-b border-gray-100 flex items-center bg-white sticky top-0 z-50">
        <div class="flex items-center gap-4">
            <img src="<?php echo e(asset('images/logo_sdit.png')); ?>" alt="Logo SDIT" class="w-10 h-10 object-contain">
            <h2 class="text-[#1E3A8A] font-bold text-lg tracking-tight uppercase">
                SDIT Al-Iman Bintara Raya Bekasi
            </h2>
        </div>
    </header>

    <main class="flex-grow flex flex-col items-center justify-center py-10 px-6">
        
        <div class="text-center mb-16">
            <h1 class="text-4xl font-black text-slate-900 mb-3 tracking-tight">Silakan pilih <span class="italic text-blue-600">role</span> kamu</h1>
        </div>
        
        <div class="max-w-6xl w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <a href="/login/guru" class="group bg-white p-8 rounded-[32px] border-2 border-gray-50 shadow-sm hover:border-blue-600 hover:shadow-2xl hover:shadow-blue-100 hover:-translate-y-2 transition-all duration-300 text-center flex flex-col items-center">
                <h3 class="text-xl font-bold text-slate-800 mb-6 group-hover:text-blue-600 transition-colors">Guru</h3>
                <div class="w-32 h-32 transform group-hover:scale-105 transition-transform">
                    <img src="<?php echo e(asset('images/guru.png')); ?>" alt="Guru" class="w-full h-full object-contain">
                </div>
            </a>

            <a href="/login/siswa" class="group bg-white p-8 rounded-[32px] border-2 border-gray-50 shadow-sm hover:border-blue-600 hover:shadow-2xl hover:shadow-blue-100 hover:-translate-y-2 transition-all duration-300 text-center flex flex-col items-center">
                <h3 class="text-xl font-bold text-slate-800 mb-6 group-hover:text-blue-600 transition-colors">Siswa</h3>
                <div class="w-32 h-32 transform group-hover:scale-105 transition-transform">
                    <img src="<?php echo e(asset('images/siswa.png')); ?>" alt="Siswa" class="w-full h-full object-contain">
                </div>
            </a>

            <a href="/login/ortu" class="group bg-white p-8 rounded-[32px] border-2 border-gray-50 shadow-sm hover:border-blue-600 hover:shadow-2xl hover:shadow-blue-100 hover:-translate-y-2 transition-all duration-300 text-center flex flex-col items-center">
                <h3 class="text-xl font-bold text-slate-800 mb-6 group-hover:text-blue-600 transition-colors">Wali Murid</h3>
                <div class="w-32 h-32 transform group-hover:scale-105 transition-transform">
                    <img src="<?php echo e(asset('images/orangtua.png')); ?>" alt="Wali Murid" class="w-full h-full object-contain">
                </div>
            </a>

            <a href="/login/admin" class="group bg-white p-8 rounded-[32px] border-2 border-gray-50 shadow-sm hover:border-blue-600 hover:shadow-2xl hover:shadow-blue-100 hover:-translate-y-2 transition-all duration-300 text-center flex flex-col items-center">
                <h3 class="text-xl font-bold text-slate-800 mb-6 group-hover:text-blue-600 transition-colors">Admin</h3>
                <div class="w-32 h-32 transform group-hover:scale-105 transition-transform">
                    <img src="<?php echo e(asset('images/admin.png')); ?>" alt="Admin" class="w-full h-full object-contain">
                </div>
            </a>

        </div>
    </main>

</body>
</html><?php /**PATH C:\xampp\htdocs\tryout-website\resources\views/pilih-role.blade.php ENDPATH**/ ?>