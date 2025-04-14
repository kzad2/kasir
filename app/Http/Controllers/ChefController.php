<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Meja;
use App\Models\DetailTransaksi;
use App\Models\Menu;
use Carbon\Carbon;

class ChefController extends Controller
{
    public function daftar_pesanan()
    {
        $detailTransaksis = DetailTransaksi::with('meja')->get();
        // dd($detailTransaksis);

        return view('chef.list_daftar_pemesanan', compact('detailTransaksis'));
    }

    public function selesai($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = 'selesai';
        $transaksi->save();

        return redirect()->back()->with('success', 'Pesanan selesai dibuat!');
    }
}
