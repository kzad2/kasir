@extends('kasir.layouts2')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Kelola Meja</h2>

    <!-- Tombol Tambah Meja -->
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('meja.create') }}" class="btn btn-success">+ Tambah Meja</a>
    </div>

    <div class="row justify-content-center">
        @forelse($mejas as $m)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card text-center shadow-lg border-0" style="border-radius: 10px;">
                    <div class="card-header text-white"
                        style="background-color: {{ $m->status == 'terisi' ? '#28a745' : '#dc3545' }}; font-size: 18px;">
                        <strong>Meja {{ $m->nomor_meja }}</strong>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                        <!-- Ikon status meja -->
                        <img src="{{ $m->status == 'terisi'
                            ? 'https://cdn-icons-png.flaticon.com/512/190/190411.png'
                            : 'https://cdn-icons-png.flaticon.com/512/1828/1828778.png' }}"
                            alt="Status Meja" class="img-fluid mb-3" style="width: 60px;">

                        <!-- Badge status -->
                        <h5>
                            <span class="badge {{ $m->status == 'terisi' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($m->status) }}
                            </span>
                        </h5>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="card-footer bg-white d-flex justify-content-around">
                        <!-- Tombol ubah status -->
                        <form action="{{ route('meja.toggleStatus', $m->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-outline-warning" title="Ubah Status">
                                {{ $m->status == 'terisi' ? 'Tandai Kosong' : 'Tandai Terisi' }}
                            </button>
                        </form>

                        <!-- Tombol hapus -->
                        <form action="{{ route('meja.destroy', $m->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus meja ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>Belum ada meja tersedia.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection


