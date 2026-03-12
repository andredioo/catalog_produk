<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;

class KomentarController extends Controller
{

    public function store(Request $request)
    {
        Komentar::create([
            'foto_id' => $request->foto_id,
            'nama' => $request->nama,
            'komentar' => $request->komentar
        ]);

        return back();
    }


    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->delete();

        return back();
    }


public function balas(Request $request, $id)
{
    $komentar = Komentar::findOrFail($id);

    $komentar->balasan = $request->balasan;

    $komentar->save();

    return back();
}
}