<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    public function melihat_laporan_penjualan()
    {
        $penjualans = DB::table('penjualans')
            ->join('menus', 'penjualans.menu_id', '=', 'menus.id')
            ->join('kategoris', 'penjualans.kategori_id', '=', 'kategoris.id')
            ->select(
                'penjualans.id',
                'penjualans.jumlah',
                'penjualans.total_harga',
                'penjualans.tanggal_transaksi',
                'menus.nama as nama_menu',
                'menus.harga as harga_satuan',
                'kategoris.nama as nama_kategori',
                DB::raw('(penjualans.total_harga - (menus.harga * penjualans.jumlah)) as laba')
            )
            ->orderBy('penjualans.tanggal_transaksi', 'desc')
            ->get();

        return view('owner.melihat_laporan_penjualan',compact('penjualans'));
    }
    public function destroy($id)
    {
        penjualan::destroy($id);
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function pendapatanBulanan()
    {
        $data = DB::table('penjualans')
            ->selectRaw('DATE_FORMAT(tanggal_transaksi, "%M") as bulan, SUM(total_harga) as total')
            ->groupBy('bulan')
            ->orderByRaw('MIN(tanggal_transaksi)')
            ->get();

// urut berdasarkan bulan sebenarnya dari januari sampai desember
        // $data = DB::table('penjualans')
        //     ->selectRaw('MONTH(tanggal_transaksi) as bulan_angka, DATE_FORMAT(tanggal_transaksi, "%M") as bulan, SUM(total_harga) as total')
        //     ->groupBy('bulan_angka', 'bulan')
        //     ->orderBy('bulan_angka')
        //     ->get();

        $labels = $data->pluck('bulan');
        $totals = $data->pluck('total');

        return view('owner.chart', [
            'labels' => $labels,
            'totals' => $totals
        ]);
    }
}
