<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>tambah akun</title>
</head>
<body>
    @include('template.nav')
    <div class="container mt-4">
        <div class="card shadow-lg p-4">
            <h2 class="mb-4 text-center text-primary">Tambah Pengguna</h2>

            <form action="{{ route('pengguna.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="admin">Admin</option>
                        <option value="kasir">kasir</option>
                        <option value="chef">chef</option>
                        <option value="owner">owner</option>
                        <option value="Pelanggan">Pelanggan</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('akun') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>
