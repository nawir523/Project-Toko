<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShoeController extends Controller
{
    public function index(Request $request)
{
    $jenis = $request->query('jenis');
    $keyword = $request->query('keyword');

    $shoes = Shoe::query();

    if ($jenis) {
        $shoes->where('jenis', $jenis);
    }

    if ($keyword) {
        $shoes->where(function ($query) use ($keyword) {
            $query->where('namamerk', 'like', "%$keyword%")
                  ->orWhere('ukuran', 'like', "%$keyword%")
                  ->orWhere('tipe', 'like', "%$keyword%")
                  ->orWhere('jenis', 'like', "%$keyword%")
                  ->orWhere('harga', 'like', "%$keyword%");
        });
    }

    $shoes = $shoes->get();

    return view('shoes.index', compact('shoes', 'jenis', 'keyword'));
}

    

    public function create()
    {
        return view('shoes.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'namamerk' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'jenis' => 'required|string|in:anak,wanita,pria,pria dan wanita',
            'ukuran' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Adjust max file size as needed
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('public', $nama_gambar);
        } else {
            $nama_gambar = null; // Set default if no image uploaded
        }

        // Create shoe record
        Shoe::create([
            'namamerk' => $request->namamerk,
            'tipe' => $request->tipe,
            'jenis' => $request->jenis,
            'ukuran' => $request->ukuran,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $nama_gambar
        ]);

        // Redirect back with success message
        return redirect()->route('admin/shoes')->with('success', 'Sepatu berhasil ditambahkan.');
    }

    public function show($id)
    {
        $shoe = Shoe::findOrFail($id);
        return view('shoes.show', compact('shoe'));
    }

    public function edit($id)
    {
        $shoe = Shoe::findOrFail($id);
        return view('shoes.edit', compact('shoe'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
       'namamerk' => 'required',
        'tipe' => 'required',
        'ukuran' => 'required',
        'harga' => 'required|integer',
        'stok' => 'required', // tambahkan validasi untuk stok
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $shoe = Shoe::findOrFail($id);
    $shoe->namamerk = $request->namamerk;
    $shoe->tipe = $request->tipe;
    $shoe->jenis = $request->jenis;
    $shoe->ukuran = $request->ukuran;
    $shoe->harga = $request->harga;
    $shoe->stok = $request->stok; // update nilai stok dari request

    if ($request->hasFile('gambar')) {
        // Hapus gambar yang lama jika ada
        if ($shoe->gambar) {
            Storage::disk('public')->delete($shoe->gambar);
        }
        // Upload gambar baru
        $imagePath = $request->file('gambar')->store('uploads', 'public');
        $shoe->gambar = $imagePath;
    }

    $shoe->save();

    return redirect()->route('admin/shoes')->with('success', 'Data sepatu berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $shoe = Shoe::findOrFail($id);

        // Delete image if exists
        if ($shoe->gambar) {
            Storage::disk('public')->delete($shoe->gambar);
        }

        $shoe->delete();

        return redirect()->route('admin/shoes')->with('success', 'Sepatu berhasil dihapus.');
    }
}
