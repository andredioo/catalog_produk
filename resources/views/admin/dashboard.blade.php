<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Vision OS</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: #0a0a0c;
            background-image: 
                radial-gradient(circle at 15% 15%, rgba(124, 58, 237, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 85% 85%, rgba(219, 39, 119, 0.08) 0%, transparent 40%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #e2e8f0;
        }

        .star-filled {
            color: #fbbf24;
            filter: drop-shadow(0 0 5px rgba(251, 191, 36, 0.6));
            animation: starPulse 2s infinite ease-in-out;
        }
        @keyframes starPulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.15); opacity: 0.9; }
        }

        .neo-card {
            background: rgba(30, 30, 40, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 32px;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .neo-card:hover { 
            transform: translateY(-12px) scale(1.02); 
            border-color: rgba(124, 58, 237, 0.6);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .modal { transition: 0.3s; visibility: hidden; opacity: 0; pointer-events: none; z-index: 100; }
        .modal.active { visibility: visible; opacity: 1; pointer-events: auto; }
        
        .glow-input:focus {
            outline: none;
            border-color: #6366f1 !important;
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        }
        .comment-scroll::-webkit-scrollbar { width: 4px; }
        .comment-scroll::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }
    </style>
</head>

<body>
    <nav class="bg-black/60 backdrop-blur-md px-10 py-5 flex justify-between items-center sticky top-0 z-50 border-b border-white/5">
        <div class="flex items-center gap-4">
            <div class="p-2.5 bg-indigo-600 rounded-xl shadow-lg shadow-indigo-600/20"><i class="fas fa-shield-alt text-white text-xl"></i></div>
            <h1 class="font-extrabold text-white uppercase tracking-tighter text-xl">Dasboard <span class="text-indigo-400">Admin</span></h1>
        </div>
        <a href="/logout" class="text-xs font-black text-red-400 border border-red-400/30 px-6 py-2.5 rounded-full hover:bg-red-500 hover:text-white transition-all tracking-widest">LOGOUT</a>
    </nav>

    <div class="p-8 max-w-7xl mx-auto">
        <div class="bg-white/5 border border-white/10 p-10 rounded-[40px] mb-16 shadow-2xl relative overflow-hidden">
            <form action="/foto/store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div class="relative border-2 border-dashed border-white/10 rounded-3xl p-8 flex flex-col items-center justify-center bg-white/[0.02] hover:bg-white/[0.04] transition-colors group">
                        <input type="file" name="gambar" id="gambar-input" required class="absolute inset-0 opacity-0 cursor-pointer z-10">
                        <div id="upload-placeholder" class="text-center">
                            <i class="fas fa-cloud-upload-alt text-5xl text-indigo-500 mb-4 group-hover:scale-110 transition-transform"></i>
                            <p class="text-sm font-bold text-gray-300 uppercase tracking-widest">Silahkan Tambah img</p>
                        </div>
                        <img id="image-preview" src="#" class="max-h-52 hidden rounded-2xl shadow-2xl border border-white/10">
                    </div>

                    <div class="flex flex-col justify-center gap-6">
                        <input type="text" name="judul" placeholder="Product Name" required class="glow-input w-full bg-black/40 border border-white/10 p-5 rounded-2xl text-base text-white">
                        <div class="grid grid-cols-2 gap-5">
                            <div class="relative">
                                <span class="absolute left-5 top-5 text-gray-500 text-sm">Rp</span>
                                <input type="number" name="harga" placeholder="Price" required class="glow-input w-full bg-black/40 border border-white/10 p-5 pl-12 rounded-2xl text-base text-white font-bold">
                            </div>
                            <select name="rating" required class="glow-input w-full bg-black/40 border border-white/10 p-5 rounded-2xl text-base text-white appearance-none cursor-pointer">
                                <option value="5">⭐⭐⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="1">⭐</option>
                            </select>
                        </div>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl font-black uppercase text-xs tracking-widest py-5 shadow-xl shadow-indigo-600/20 active:scale-95 transition-all">Publish To Gallery</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($fotos as $foto)
            <div class="neo-card flex flex-col h-full relative group">
                <div class="absolute top-5 right-5 flex gap-3 z-20 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                    <button onclick="toggleModal('edit-foto-{{ $foto->id }}')" class="bg-indigo-600 p-3 rounded-xl text-white shadow-lg hover:bg-indigo-500"><i class="fas fa-edit"></i></button>
                    <a href="/foto/delete/{{ $foto->id }}" onclick="return confirm('Hapus Produk?')" class="bg-red-600 p-3 rounded-xl text-white shadow-lg hover:bg-red-500"><i class="fas fa-trash"></i></a>
                </div>

                <div class="relative overflow-hidden h-72 rounded-t-[32px]">
                    <img src="{{ asset('foto/'.$foto->gambar) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0c] via-transparent to-transparent opacity-80"></div>
                    
                    <div class="absolute bottom-5 left-6 bg-black/60 backdrop-blur-xl px-4 py-2 rounded-2xl border border-white/10 flex gap-1.5 shadow-2xl">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star text-xs {{ $i <= ($foto->rating ?? 5) ? 'star-filled' : 'text-gray-600' }}"></i>
                        @endfor
                    </div>
                </div>

                <div class="p-8 flex flex-col flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-extrabold text-white uppercase text-lg tracking-tight leading-tight border-l-4 border-indigo-500 pl-4">{{ $foto->judul }}</h3>
                    </div>
                    <p class="text-indigo-400 font-black text-xl mb-6 pl-5">Rp {{ number_format($foto->harga ?? 0,0,',','.') }}</p>

                    <div class="bg-white/[0.03] rounded-3xl p-6 border border-white/5 flex-1 flex flex-col">
                        <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                            <span class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span> Feedback Signals
                        </p>
                        
                        <div class="comment-scroll max-h-60 overflow-y-auto space-y-5 pr-2">
                            @forelse($foto->komentars as $komen)
                            <div class="border-l-2 border-white/10 pl-4 relative group/item">
                                <a href="/komentar/delete/{{ $komen->id }}" class="absolute -right-2 top-0 text-red-500/30 hover:text-red-500 opacity-0 group-hover/item:opacity-100 transition-all">
                                    <i class="fas fa-times-circle"></i>
                                </a>

                                <span class="text-xs font-extrabold text-pink-400 uppercase tracking-tighter">{{ $komen->nama }}</span>
                                <p class="text-sm text-white/70 leading-relaxed mt-1">"{{ $komen->komentar }}"</p>
                                
                                <div class="mt-3 pt-3 border-t border-white/5 bg-black/20 rounded-xl p-3">
                                    @if($komen->balasan)
                                        <div id="display-balas-{{ $komen->id }}" class="flex justify-between items-start">
                                            <p class="text-xs text-green-400 font-semibold italic">
                                                Admin: <span class="text-white/90 not-italic">{{ $komen->balasan }}</span>
                                            </p>
                                            <button onclick="showEditBalas('{{ $komen->id }}')" class="text-gray-500 hover:text-indigo-400 ml-2">
                                                <i class="fas fa-pen-nib text-[10px]"></i>
                                            </button>
                                        </div>

                                        <form id="form-edit-balas-{{ $komen->id }}" action="/komentar/balas/{{ $komen->id }}" method="POST" class="hidden">
                                            @csrf
                                            <input type="text" name="balasan" value="{{ $komen->balasan }}" class="w-full bg-black/40 border border-indigo-500/30 rounded-lg px-3 py-2 text-xs text-white outline-none">
                                            <div class="flex gap-2 mt-2">
                                                <button type="submit" class="text-[10px] bg-indigo-600 px-3 py-1.5 rounded-lg text-white font-bold">Save</button>
                                                <button type="button" onclick="showEditBalas('{{ $komen->id }}')" class="text-[10px] text-gray-500">Cancel</button>
                                            </div>
                                        </form>
                                    @else
                                        <form action="/komentar/balas/{{ $komen->id }}" method="POST" class="flex gap-3">
                                            @csrf
                                            <input type="text" name="balasan" placeholder="Write a response..." required class="w-full bg-transparent text-xs border-b border-white/10 outline-none focus:border-indigo-500 text-white py-1">
                                            <button class="text-indigo-500 hover:scale-110 transition-transform"><i class="fas fa-paper-plane"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-6 opacity-20">
                                <i class="fas fa-inbox text-2xl mb-2 block"></i>
                                <p class="text-[10px] uppercase font-bold tracking-widest">No Signals Detected</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div id="edit-foto-{{ $foto->id }}" class="modal fixed inset-0 flex items-center justify-center p-6 bg-black/90 backdrop-blur-md">
                    <div class="bg-slate-900 border border-white/10 p-10 rounded-[40px] w-full max-w-lg shadow-2xl">
                        <h4 class="text-white font-black mb-8 text-center uppercase tracking-[0.2em] text-lg">System Update</h4>
                        <form action="{{ url('/foto/update/'.$foto->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase ml-2">Identification</label>
                                <input type="text" name="judul" value="{{ $foto->judul }}" class="glow-input w-full bg-black/40 border border-white/10 p-5 rounded-2xl text-white">
                            </div>
                            <div class="grid grid-cols-2 gap-5">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase ml-2">Price Protocol</label>
                                    <input type="number" name="harga" value="{{ $foto->harga ?? 0 }}" class="glow-input w-full bg-black/40 border border-white/10 p-5 rounded-2xl text-white">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase ml-2">Rank</label>
                                    <select name="rating" class="glow-input w-full bg-black/40 border border-white/10 p-5 rounded-2xl text-white">
                                        @for($r=5; $r>=1; $r--)
                                            <option value="{{ $r }}" {{ ($foto->rating ?? 5)==$r?'selected':'' }}>{{ $r }} Stars</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="bg-white/5 p-6 rounded-2xl border border-white/5">
                                <p class="text-[10px] text-gray-500 font-bold uppercase mb-3">Re-upload Visual</p>
                                <input type="file" name="gambar" class="text-xs text-gray-400">
                            </div>
                            <div class="flex gap-4 pt-4">
                                <button type="button" onclick="toggleModal('edit-foto-{{ $foto->id }}')" class="flex-1 p-5 bg-white/5 rounded-2xl text-xs font-bold uppercase hover:bg-white/10 transition-colors">Abort</button>
                                <button type="submit" class="flex-1 p-5 bg-indigo-600 rounded-2xl text-xs font-bold uppercase shadow-lg shadow-indigo-600/30">Commit Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        function toggleModal(id) { document.getElementById(id).classList.toggle('active'); }
        
        function showEditBalas(id) {
            document.getElementById('display-balas-' + id).classList.toggle('hidden');
            document.getElementById('form-edit-balas-' + id).classList.toggle('hidden');
        }

        document.getElementById('gambar-input').addEventListener('change', function(){
            const file = this.files[0];
            if(file){
                const reader = new FileReader();
                reader.onload = function(e){
                    const img = document.getElementById('image-preview');
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                    document.getElementById('upload-placeholder').classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>