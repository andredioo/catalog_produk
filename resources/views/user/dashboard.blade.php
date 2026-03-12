<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Gallery</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #f0f2f5;
            background-image: radial-gradient(circle at 0% 0%, #e0e7ff 0%, transparent 50%), 
                              radial-gradient(circle at 100% 100%, #fae8ff 0%, transparent 50%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.05);
        }
        .img-container {
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0% 100%);
        }
        .like-badge {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
        }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #fda4af; border-radius: 10px; }
    </style>
</head>

<body class="min-h-screen pb-20">

    <nav class="sticky top-0 z-50 px-6 py-4">
        <div class="max-w-7xl mx-auto glass-card rounded-3xl px-8 py-4 flex justify-between items-center border border-white/50">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
                    <i class="fas fa-heart text-white"></i>
                </div>
                <h1 class="text-xl font-extrabold text-slate-800 tracking-tighter uppercase">Gallery<span class="text-indigo-600">Vibes</span></h1>
            </div>
            <a href="/logout" class="bg-slate-900 text-white px-6 py-2.5 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-rose-600 transition-all active:scale-95">
                Logout
            </a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto p-6 mt-10">

        <div class="flex justify-between items-center mb-12 animate__animated animate__fadeIn">
            <header>
                <span class="text-rose-500 font-black text-[10px] uppercase tracking-[0.4em] mb-2 block">Social Interaction</span>
                <h2 class="text-5xl font-black text-slate-900 mt-2 tracking-tight">Express Love.</h2>
            </header>

            <button onclick="document.getElementById('add-photo-modal').classList.remove('hidden')"
                    class="bg-slate-900 text-white px-8 py-4 rounded-3xl text-sm font-black uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-xl">
                <i class="fas fa-camera-retro mr-2"></i> Post Foto
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @foreach($fotos as $foto)
            <div class="glass-card rounded-[3.5rem] overflow-hidden flex flex-col h-full animate__animated animate__fadeInUp">
                
                <div class="relative img-container overflow-hidden group">
                    <img src="{{ asset('foto/'.$foto->gambar) }}" class="w-full h-80 object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute top-6 right-6">
                        <div class="like-badge text-white px-4 py-2 rounded-2xl text-xs font-black shadow-lg flex items-center gap-2">
                            <i class="fas fa-heart animate-pulse"></i>
                            {{ $foto->komentars->count() }} Likes
                        </div>
                    </div>
                </div>

                <div class="p-8 flex-1 flex flex-col">
                    <h3 class="text-2xl font-extrabold text-slate-800 leading-tight mb-4">{{ $foto->judul }}</h3>

                    <div class="flex-1 mb-8 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Appreciation from:</p>
                        <div class="flex flex-wrap gap-2">
                            @forelse($foto->komentars as $komen)
                            <div class="group relative">
                                <div class="bg-white border border-rose-100 px-4 py-2 rounded-2xl flex items-center gap-2 shadow-sm hover:border-rose-400 transition-colors">
                                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                    <span class="text-xs font-bold text-slate-700">{{ $komen->nama }}</span>
                                </div>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block w-32 bg-slate-800 text-white text-[10px] p-2 rounded-lg text-center">
                                    {{ $komen->komentar }}
                                </div>
                            </div>
                            @empty
                            <p class="text-xs text-slate-400 italic">No love yet. Be the first!</p>
                            @endforelse
                        </div>
                    </div>

                    <form action="/komentar/store" method="POST" class="mt-auto pt-6 border-t border-slate-100">
                        @csrf
                        <input type="hidden" name="foto_id" value="{{ $foto->id }}">
                        <input type="hidden" name="komentar" value="Sent a heart to this photo">
                        
                        <div class="flex gap-3">
                            <div class="relative flex-1">
                                <i class="fas fa-user absolute left-5 top-1/2 -translate-y-1/2 text-rose-400 text-xs"></i>
                                <input type="text" name="nama" placeholder="Your Name" required
                                    class="w-full bg-rose-50/50 border-none rounded-2xl pl-12 pr-5 py-4 text-sm focus:ring-2 focus:ring-rose-500 transition-all outline-none font-bold text-slate-700">
                            </div>
                            <button class="like-badge w-14 h-14 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-rose-200 hover:scale-110 active:scale-90 transition-all">
                                <i class="fas fa-heart text-xl"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div id="add-photo-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden z-50 flex items-center justify-center p-6">
        <div class="bg-white rounded-[3rem] max-w-lg w-full p-10 relative shadow-2xl">
            <button onclick="document.getElementById('add-photo-modal').classList.add('hidden')"
                    class="absolute top-6 right-6 text-slate-400 hover:text-rose-500 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>

            <h3 class="text-3xl font-black mb-2 text-slate-900 tracking-tight">Post New Asset</h3>
            <p class="text-slate-500 text-sm mb-8">Share your visual inspiration with the world.</p>

            <form action="/foto/store" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Asset Title</label>
                    <input type="text" name="judul" required placeholder="e.g. Summer Breeze"
                        class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-indigo-500 outline-none font-medium">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Select File</label>
                    <div class="relative w-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl p-4 flex flex-col items-center justify-center hover:border-indigo-400 transition-colors">
                        <i class="fas fa-cloud-upload-alt text-3xl text-indigo-400 mb-2"></i>
                        <input type="file" name="gambar" accept="image/*" required class="absolute inset-0 opacity-0 cursor-pointer">
                        <p class="text-[10px] text-slate-500 font-bold uppercase">Click to browse or drag file</p>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-slate-900 text-white py-5 rounded-2xl font-black uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-xl shadow-indigo-100 flex items-center justify-center gap-3">
                    <i class="fas fa-paper-plane"></i> Launch Asset
                </button>
            </form>
        </div>
    </div>

</body>  
</html>