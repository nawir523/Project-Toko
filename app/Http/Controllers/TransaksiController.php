<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil semua transaksi yang sudah dilakukan
        $transaksis = transaksi::all();
        
        // Ambil semua sepatu untuk pilihan dalam form
        $shoes = Shoe::all();

        return view('transaksi.index', compact('transaksis', 'shoes'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'shoe_id' => 'required|exists:shoes,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Simpan transaksi ke database
        Transaksi::create([
            'shoe_id' => $request->shoe_id,
            'jumlah' => $request->jumlah,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }

    // Method untuk mengunduh data transaksi dalam format Excel
    public function downloadExcel()
    {
        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }
}
