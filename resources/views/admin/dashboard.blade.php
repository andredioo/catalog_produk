<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Gallery Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
        }
        .glass-panel {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .neo-button-red {
            background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }
        .neo-button-red:hover {
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5);
            transform: translateY(-2px);
        }
        .custom-table tr {
            transition: all 0.3s ease;
        }
        .custom-table tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }
    </style>
</head>
<body class="min-h-screen p-4 md:p-12">

    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h1 class="text-4xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">
                    Gallery Foto
                </h1>
                <p class="text-slate-400 mt-1">Manage your visual assets and gallery content.</p>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="text-right hidden md:block">
                    <p class="text-xs uppercase tracking-widest text-slate-500 font-bold">Logged in as</p>
                    <p class="text-sm font-medium text-indigo-300">Administrator</p>
                </div>
                <a href="/logout" class="bg-slate-800 hover:bg-slate-700 text-white px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider border border-slate-700 transition-all active:scale-95">
                    <i class="fas fa-sign-out-alt mr-2"></i> Terminate Session
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="animate__animated animate__fadeInDown bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 px-6 py-4 rounded-2xl mb-8 flex items-center gap-4">
                <i class="fas fa-check-circle"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="glass-panel rounded-[2rem] overflow-hidden shadow-2xl">
            <div class="px-8 py-6 border-b border-white/10 flex justify-between items-center bg-white/5">
                <h2 class="text-lg font-bold tracking-wide">Media Library</h2>
                <span class="bg-indigo-500/20 text-indigo-400 px-3 py-1 rounded-full text-[10px] font-black uppercase">
                    {{ count($fotos) }} Items Total
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full custom-table">
                    <thead>
                        <tr class="text-slate-400 text-xs uppercase tracking-[0.2em]">
                            <th class="px-8 py-5 text-left font-bold">Asset Name</th>
                            <th class="px-8 py-5 text-center font-bold">Visualization</th>
                            <th class="px-8 py-5 text-right font-bold">Operations</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($fotos as $foto)
                        <tr class="group">
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-white font-bold text-lg group-hover:text-indigo-400 transition-colors">
                                        {{ $foto->judul }}
                                    </span>
                                    <span class="text-[10px] text-slate-500 uppercase mt-1 tracking-tighter italic">
                                        ID: #{{ str_pad($foto->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-center">
                                    <div class="relative group/img">
                                        <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl blur opacity-25 group-hover/img:opacity-75 transition duration-1000 group-hover/img:duration-200"></div>
                                        <img src="{{ asset('foto/'.$foto->gambar) }}" 
                                             class="relative rounded-xl object-cover border border-white/10" 
                                             style="width: 120px; height: 70px;" 
                                             alt="{{ $foto->judul }}">
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-end">
                                    <form action="{{ route('foto.destroy', $foto->id) }}" method="POST" onsubmit="return confirm('Execute deletion sequence for this asset?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="neo-button-red text-white w-10 h-10 rounded-xl flex items-center justify-center transition-all active:scale-90">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center opacity-20">
                                    <i class="fas fa-box-open text-6xl mb-4"></i>
                                    <p class="text-xl font-light uppercase tracking-[0.3em]">No Assets Detected</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>