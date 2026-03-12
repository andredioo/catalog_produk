<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Lapor Masyarakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #40e8e8 100%);
        }
    </style>
</head>

<body class="bg-gradient min-h-screen flex items-center justify-center p-4">

    <div class="glass-card w-full max-w-md p-8 rounded-3xl shadow-2xl animate__animated animate__fadeInDown">
        
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-600 rounded-2xl shadow-lg mb-4 animate__animated animate__zoomIn animate__delay-1s">
                <i class="fas fa-user-plus text-2xl text-white"></i>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Daftar Akun</h2>
            <p class="text-gray-500 mt-2 font-medium">Lengkapi data untuk masuk</p>
        </div>

        <form action="/register" method="POST" class="space-y-4">
            @csrf

            <div class="group">
                <label class="block text-sm font-semibold text-gray-700 mb-1 ml-1">Nama Lengkap</label>
                <div class="relative transition-all duration-300 group-focus-within:scale-[1.01]">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400 group-focus-within:text-purple-600 transition-colors"></i>
                    </div>
                    <input type="text" name="name" placeholder="Masukkan nama lengkap" required
                        class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-gray-900 focus:ring-4 focus:ring-purple-100 focus:border-purple-600 focus:bg-white outline-none transition-all">
                </div>
            </div>

            <div class="group">
                <label class="block text-sm font-semibold text-gray-700 mb-1 ml-1">Alamat Email</label>
                <div class="relative transition-all duration-300 group-focus-within:scale-[1.01]">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400 group-focus-within:text-purple-600 transition-colors"></i>
                    </div>
                    <input type="email" name="email" placeholder="contoh@email.com" required
                        class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-gray-900 focus:ring-4 focus:ring-purple-100 focus:border-purple-600 focus:bg-white outline-none transition-all">
                </div>
            </div>

            <div class="group">
                <label class="block text-sm font-semibold text-gray-700 mb-1 ml-1">Password</label>
                <div class="relative transition-all duration-300 group-focus-within:scale-[1.01]">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400 group-focus-within:text-purple-600 transition-colors"></i>
                    </div>
                    <input type="password" name="password" placeholder="••••••••" required
                        class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-gray-900 focus:ring-4 focus:ring-purple-100 focus:border-purple-600 focus:bg-white outline-none transition-all">
                </div>
            </div>

            <button type="submit" 
                class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-purple-200 transform transition active:scale-95 hover:translate-y-[-2px] focus:ring-4 focus:ring-purple-300 mt-2">
                Daftar Sekarang <i class="fas fa-paper-plane ml-2 text-sm"></i>
            </button>

        </form>

        <div class="mt-6 text-center border-t border-gray-100 pt-5">
            <p class="text-gray-600">
                Sudah punya akun? 
                <a href="/login" class="text-purple-600 font-bold hover:text-purple-800 transition-colors">
                    Login di sini
                </a>
            </p>
        </div>

    </div>

</body>
</html>