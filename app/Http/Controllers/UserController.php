<?php

namespace App\Http\Controllers;

use App\Models\menu;
use App\Models\Meja;
use App\Models\Makanan;
use App\Models\minumen;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\transaksi as ModelsTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function home()
    {
        $makanan = menu::where("kategori_id",1)->get();
        $minuman = menu::where("kategori_id",2)->get();


        return view('home', compact('makanan','minuman'));
    }


    public function detail($id)
    {
        $item = Menu::findOrFail($id);
        $meja = Meja::findOrFail($id);

        return view('detail', compact('item', 'meja'));
    }

    public function keranjang()
    {
        $detailTransaksis = DetailTransaksi::where('user_id', auth()->id())
        ->where('status', 'keranjang')
        ->with('menu')
        ->with('meja')
        ->get();

        $total = $detailTransaksis->sum('totalharga');

        return view('keranjang', compact('detailTransaksis', 'total'));
    }

    public function postKeranjang(Request $request, Menu $menu, Meja $meja)
    {
        // dd("jawa");
        $request->validate([
            'banyak' => 'required|integer|min:1',
        ]);

        DetailTransaksi::create([
            'qty' => $request->banyak,
            'user_id' => Auth::id(),
            'meja_id' => $meja->id,
            'menu_id' => $menu->id,
            'status' => 'keranjang',
            'totalharga' => $menu->harga * $request->banyak,
        ]);

        return redirect()->route('pelanggan.keranjang')->with('status', 'Produk berhasil dimasukkan ke keranjang.');
    }


    public function hapusItem($id)
    {
        $item = DetailTransaksi::findOrFail($id);

        if ($item->user_id !== auth()->id()) {
            abort(403);
        }

        $item->delete();

        return back()->with('status', 'Item berhasil dihapus dari keranjang.');
    }


    public function hapusSemua()
    {
        $user = auth()->user();

        $items = DetailTransaksi::where('user_id', $user->id)
            ->where('status', 'keranjang');

        if ($items->count() > 0) {
            $items->delete();
            return back()->with('status', 'Semua item berhasil dihapus.');
        }

        return back()->with('status', 'Tidak ada item untuk dihapus.');
    }


    public function bayar($detailTransaksiId)
    {
        $detailTransaksi = DetailTransaksi::where('id', $detailTransaksiId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

             // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $orderId = rand();
        $params = array(
            'transaction_details' => array(
                'order_id' => $orderId,
                'gross_amount' => $detailTransaksi->totalharga,
            ),
            'customer_details'=> array(
                'first_name'=> Auth::user()->name,
                'email'=> Auth::user()->email,
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('bayar', compact('detailTransaksi','snapToken','orderId'));
    }

    public function bayarSemua()
    {
        $user = Auth::user();

        $detailTransaksis = DetailTransaksi::where('user_id', $user->id)
            ->where('status', 'keranjang')
            ->get();

        if ($detailTransaksis->isEmpty()) {
            return redirect()->back()->with('status', 'pesanan kamu kosong!');
        }

        DB::beginTransaction();

        try {
            foreach ($detailTransaksis as $detail) {
                $detail->status = 'selesai';
                $detail->save();
            }

            DB::commit();
            return redirect()->route('pelanggan.keranjang')->with('status', 'Semua item berhasil dibayar!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('status', 'Terjadi kesalahan saat memproses pembayaran.');
        }
    }


    public function prosesbayar(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk checkout.');
        }

        $request->validate([
            'bukti_transfer' => 'required|file|mimes:jpg,png,jpeg|max:2048',
        ]);

        $detailTransaksi = DetailTransaksi::where('user_id', Auth::id())
            ->where('status', 'keranjang')
            ->get();

        if ($detailTransaksi->isEmpty()) {
            return redirect()->route('pelanggan.keranjang')->with('error', 'Keranjang kosong.');
        }

        $totalHarga = $detailTransaksi->sum('total_harga');

        $transaksi = Transaksi::create([
            'user_id' => Auth::id(),
            'totalharga' => $totalHarga,
            'kode' => 'INV' . Str::upper(Str::random(8)),
        ]);

        $buktiTransferPath = $request->file('bukti_transfer')->store('images');

        foreach ($detailTransaksi as $item) {
            $item->update([
                'transaksi_id' => $transaksi->id,
                'status' => 'checkout',
                'bukti_transaksi' => $buktiTransferPath,
            ]);
        }

        return view('kasir.history_transaksi')->with('status', 'Checkout berhasil!');
    }

    public function summary()
    {
        $transaksi = Transaksi::where('user_id', Auth::id())->latest()->first();
        $detailTransaksi = DetailTransaksi::where('transaksi_id', $transaksi->id)->get();

        return view('kasir.history_transaksi', compact('transaksi', 'detailTransaksi'));
    }
    public function sukses(Request $request, int $id)
    {
    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
   // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$isProduction = false;      // Set sanitization on (default)
    // Set 3DS transaction for credit card to true
    //  \Midtrans\Config::$is3ds = true;
        $orderId = $request->query("orderId");
        $status = \Midtrans\Transaction::status($orderId);
// dd($status->issuer);
// var_dump($status);

        $detailTransaksi = DetailTransaksi::findOrFail($id);
        $detailTransaksi->status = 'checkout';
        $detailTransaksi->save();
        ModelsTransaksi::create(
            [
                'user_id' => Auth::id(),
                'totalharga' => $detailTransaksi->totalharga,
                'kode' => $orderId,
                'status_pesanan' => $detailTransaksi->status,
                'issuer' => $status->issuer,
                'payment_type'=> $status->payment_type,
                'transaction_time' => $status->transaction_time
            ]
        );

        return redirect()->route('home')->with('status', 'Checkout berhasil!');
    }
}
