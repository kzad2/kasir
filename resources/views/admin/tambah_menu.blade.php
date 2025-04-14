<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('template.nav')

    <div class="container mt-5">
        <div class="card p-4 shadow">
            <h3 class="text-center mb-4">Tambah Menu Baru</h3>
            <form action="{{ route('posttambah_menu') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Menu</label>
                    <input type="text" class="form-control" required name="name">
                </div>
                {{-- <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" required name="desc">
                </div> --}}
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" class="form-control" required name="harga">
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" name="foto" accept="image/*" required class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
</body>
</html>
