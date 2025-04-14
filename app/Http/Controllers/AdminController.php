<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use App\Models\Kategori;
use App\Models\Makanan;
use App\Models\Minuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function mengelola_data_menu()
    {
        $data = Menu::with('kategori')->get();
        $kategori = Kategori::all();
        return view('admin.mengelola_data_menu', compact('data', 'kategori'));
    }

    public function tambah_menu()
    {
        $menu = menu::all();
        $kategori = kategori::all();
        return view('admin.tambah_menu', compact('menu', 'kategori'));
    }

    public function posttambah_menu(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|integer',
            'name' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'required|image',
        ]);

        $filename = $request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('img'), $filename);

        Menu::create([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->name,
            'harga' => $request->harga,
            'foto' => $filename,
        ]);

        return redirect()->route('mengelola_data_menu')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit_menu($id)
    {
        $menu = menu::findOrFail($id);
        $kategori = kategori::all();
        return view('admin.edit_menu', compact('menu', 'kategori'));
    }

    public function perbarui_menu(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'kategori_id' => 'required|integer',
            'name' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'image|nullable',
        ]);

        $data = [
            'kategori_id' => $request->kategori_id,
            'nama' => $request->name,
            'harga' => $request->harga,
        ];

        if ($request->hasFile('foto')) {
            $filename = $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('img'), $filename);
            $data['foto'] = $filename;
        }

        $menu->update($data);

        return redirect()->route('mengelola_data_menu')->with('success', 'Menu berhasil diperbarui.');
    }

    public function hapus_menu($id)
    {
        $item = Menu::findOrFail($id);
        $item->delete();

        return redirect()->route('mengelola_data_menu')->with('success', 'Menu berhasil dihapus.');
    }

    public function akun()
    {
        $data = User::all();
        return view('admin.mengelola_akun_pengguna', compact('data'));
    }

    public function penggunatambah()
    {
        $user = User::all();
        return view('admin.tambah_akun', compact('user'));
    }

    public function simpan_akun(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('akun')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function ubah_akun($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_akun', compact('user'));
    }

    public function update_akun(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|string'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('akun')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function hapus_akun($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('akun')->with('success', 'Pengguna berhasil dihapus.');
    }
}
