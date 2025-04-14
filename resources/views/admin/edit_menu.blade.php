<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('template.nav')

    <div class="container mt-5">
        <div class="card p-4 shadow">
            <h3 class="text-center mb-4">Edit Menu</h3>
            <form action="{{ route('perbarui_menu', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Menu</label>
                    <input type="text" class="form-control" required name="name" value="{{ $menu->nama }}">
                </div>
                {{-- <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" required name="desc" value="{{ $menu->desc }}">
                </div> --}}
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" class="form-control" required name="harga" value="{{ $menu->harga }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto (Kosongkan jika tidak diganti)</label>
                    <input type="file" name="foto" accept="image/*" class="form-control">
                    <small class="text-muted">Foto saat ini: {{ $menu->foto }}</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $menu->kategori_id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</body>
</html>
