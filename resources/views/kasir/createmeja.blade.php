@extends('kasir.layouts2')

@section('content')
<div class="container">
    <h3 class="mb-4 text-center">Tambah Meja Baru</h3>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('meja.store') }}" method="POST" class="card p-4 shadow">
                @csrf

                <div class="mb-3">
                    <label for="nomor_meja" class="form-label">Nomor Meja</label>
                    <input type="text" name="nomor_meja" id="nomor_meja" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status Meja</label>
                    <select name="status" id="status" class="form-select">
                        <option value="kosong">Kosong</option>
                        <option value="terisi">Terisi</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('kelolameja') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
