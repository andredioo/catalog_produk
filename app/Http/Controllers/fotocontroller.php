<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;

class FotoController extends Controller
{
    // Tampilkan dashboard admin
    public function index()
    {
        $fotos = Foto::with('komentars')->get();
        return view('admin.dashboard', compact('fotos'));
    }

    // Simpan foto baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'harga' => 'nullable|integer',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $fileName = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('foto'), $fileName);
        }

        Foto::create([
            'judul' => $request->judul,
            'gambar' => $fileName,
            'harga' => $request->harga ?? 0,
            'rating' => $request->rating ?? 0,
        ]);

        return redirect()->back()->with('success', 'Foto berhasil diupload');
    }

    // Update data foto
    public function update(Request $request, $id)
    {
        $foto = Foto::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'harga' => 'nullable|integer',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        // Jika ada gambar baru, hapus file lama
        if ($request->hasFile('gambar')) {
            if ($foto->gambar && file_exists(public_path('foto/'.$foto->gambar))) {
                unlink(public_path('foto/'.$foto->gambar));
            }
            $file = $request->file('gambar');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('foto'), $fileName);
            $foto->gambar = $fileName;
        }

        $foto->judul = $request->judul;
        $foto->harga = $request->harga ?? $foto->harga;
        $foto->rating = $request->rating ?? $foto->rating;
        $foto->save();

        return redirect()->back()->with('success', 'Foto berhasil diupdate');
    }

    // Hapus foto
    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);

        // Hapus file gambar dari storage/public/foto
        if ($foto->gambar && file_exists(public_path('foto/'.$foto->gambar))) {
            unlink(public_path('foto/'.$foto->gambar));
        }

        $foto->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus');
    }
}