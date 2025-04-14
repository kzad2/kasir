<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\meja;
use App\Models\transaksi;

class KasirController extends Controller
{
    public function history_transaksi()
    {
        $transaksis = Transaksi::with(['meja', 'detailTransaksis'])->get();

        foreach ($transaksis as $transaksi) {
            foreach ($transaksi->detailTransaksis as $detail) {
                $detail->item_nama = $detail->item()?->nama ?? 'Tidak diketahui';
            }
        }
        return view('kasir.history_transaksi', compact('transaksis'));
    }
    public function kelolameja()
    {
        $mejas = meja::all();

        return view('kasir.kelolameja',compact('mejas'));
    }
    public function create()
    {
        return view('kasir.createmeja');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required|unique:mejas,nomor_meja',
            'status' => 'required|in:terisi,kosong',
        ]);

        Meja::create($request->all());

        return redirect()->route('kelolameja')->with('success', 'Meja berhasil ditambahkan.');
    }

    public function toggleStatus($id)
    {
        $meja = Meja::findOrFail($id);
        $meja->status = $meja->status === 'terisi' ? 'kosong' : 'terisi';
        $meja->save();

        return redirect()->route('kelolameja')->with('success', 'Status meja diperbarui.');
    }

    public function destroy($id)
    {
        $meja = Meja::findOrFail($id);
        $meja->delete();

        return redirect()->route('kelolameja')->with('success', 'Meja berhasil dihapus.');
    }
}
