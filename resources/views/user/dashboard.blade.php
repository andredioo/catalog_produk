<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visionary Gallery - Premium Experience</title>
    
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

        .admin-reply-blob {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            position: relative;
        }

        .admin-reply-blob::before {
            content: '';
            position: absolute;
            left: 20px;
            top: -8px;
            width: 0;
            height: 0;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-bottom: 8px solid #6366f1;
        }

        .img-container {
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0% 100%);
        }

        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        .rating-star { color: #e2e8f0; cursor: pointer; transition: 0.3s; }
        .rating-star.active { color: #f59e0b; transform: scale(1.2); }
    </style>
</head>

<body class="min-h-screen pb-20">

    <nav class="sticky top-0 z-50 px-6 py-4">
        <div class="max-w-7xl mx-auto glass-card rounded-3xl px-8 py-4 flex justify-between items-center border border-white/50">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
                    <i class="fas fa-bolt text-white"></i>
                </div>
                <h1 class="text-xl font-extrabold text-slate-800 tracking-tighter uppercase">Dashboard<span class="text-indigo-600">User</span></h1>
            </div>
            <a href="/logout" class="bg-slate-900 text-white px-6 py-2.5 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-indigo-600 transition-all active:scale-95">
                Logout
            </a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto p-6 mt-10">
        
        <header class="mb-16 text-center animate__animated animate__fadeIn">
            <span class="text-indigo-600 font-black text-[10px] uppercase tracking-[0.4em] mb-2 block">Premium Inventory Protocol</span>
            <h2 class="text-5xl font-black text-slate-900 mt-2 tracking-tight">Product Showcase.</h2>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @foreach($fotos as $foto)
            <div class="glass-card rounded-[3rem] overflow-hidden flex flex-col h-full animate__animated animate__fadeInUp border-white">
                
                <div class="relative img-container overflow-hidden group">
                    <img src="{{ asset('foto/'.$foto->gambar) }}" class="w-full h-80 object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
                        <div class="text-white">
                            <p class="text-xs font-bold uppercase tracking-widest opacity-70">Published Asset</p>
                            <h4 class="text-xl font-bold italic">#{{ $loop->iteration }} Collection</h4>
                        </div>
                    </div>
                </div>

                <div class="p-8 flex-1 flex flex-col">
                    <div class="mb-6">
                        <div class="flex justify-between items-start">
                            <h3 class="text-2xl font-extrabold text-slate-800 leading-tight flex-1">{{ $foto->judul }}</h3>
                            <div class="bg-indigo-50 text-indigo-600 px-4 py-2 rounded-2xl font-black text-sm ml-4">
                                <i class="fas fa-star mr-1"></i> {{ $foto->rating ?? '5.0' }}
                            </div>
                        </div>
                        <p class="text-indigo-600 font-black text-2xl mt-2 tracking-tighter">
                            Rp {{ number_format($foto->harga ?? 0, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="flex-1 mb-6 space-y-4 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                        @forelse($foto->komentars as $komen)
                        <div class="animate__animated animate__fadeIn">
                            <div class="flex gap-3 items-start">
                                <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-bold">
                                    {{ substr($komen->nama, 0, 1) }}
                                </div>
                                <div class="bg-slate-100 rounded-2xl rounded-tl-none p-3 max-w-[85%]">
                                    <p class="text-[10px] font-black text-slate-500 uppercase">{{ $komen->nama }}</p>
                                    <p class="text-sm text-slate-700 mt-1">"{{ $komen->komentar }}"</p>
                                </div>
                            </div>

                            @if($komen->balasan)
                            <div class="mt-3 ml-8">
                                <div class="admin-reply-blob p-4 rounded-3xl rounded-tl-none shadow-lg shadow-indigo-100">
                                    <div class="flex items-center gap-2 mb-1">
                                        <i class="fas fa-check-circle text-indigo-200 text-[10px]"></i>
                                        <span class="text-[9px] font-black text-indigo-100 uppercase tracking-widest">Admin Response</span>
                                    </div>
                                    <p class="text-xs text-white leading-relaxed font-medium">
                                        {{ $komen->balasan }}
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                        @empty
                        <p class="text-xs text-slate-400 italic text-center py-4">Belum ada sinyal masuk...</p>
                        @endforelse
                    </div>

                    <form action="/komentar/store" method="POST" class="mt-auto space-y-4 pt-6 border-t border-slate-100">
                        @csrf
                        <input type="hidden" name="foto_id" value="{{ $foto->id }}">
                        
                        <div class="flex justify-center gap-3 mb-2">
                            @for($i=1; $i<=5; $i++)
                            <i class="fas fa-star rating-star text-lg" onclick="setRating(this, {{ $i }}, 'rating-input-{{ $foto->id }}')"></i>
                            @endfor
                            <input type="hidden" name="rating" id="rating-input-{{ $foto->id }}" value="5">
                        </div>

                        <div class="relative">
                            <input type="text" name="nama" placeholder="Username" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-indigo-500 transition-all outline-none">
                        </div>
                        
                        <div class="flex gap-2">
                            <input type="text" name="komentar" placeholder="Write a feedback..." required
                                class="flex-1 bg-slate-50 border-none rounded-2xl px-5 py-3 text-sm focus:ring-2 focus:ring-indigo-500 transition-all outline-none">
                            <button class="w-12 h-12 bg-indigo-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200 hover:scale-105 active:scale-95 transition-all">
                                <i class="fas fa-paper-plane text-xs"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        function setRating(el, count, inputId) {
            let container = el.parentElement;
            let stars = container.querySelectorAll('.rating-star');
            let input = document.getElementById(inputId);
            input.value = count;
            stars.forEach((star, index) => {
                if(index < count) {
                    star.classList.add('active', 'fas');
                    star.classList.remove('far');
                } else {
                    star.classList.remove('active', 'fas');
                    star.classList.add('far');
                }
            });
        }
    </script>
</body>  
</html>