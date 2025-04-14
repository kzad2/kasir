<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>edit akun</title>
</head>
<body>
    @include('template.nav')

<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-center text-warning">Edit Pengguna</h2>

        <form action="{{ route('pengguna.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="kasir" {{ $user->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
                    <option value="chef" {{ $user->role == 'chef' ? 'selected' : '' }}>Chef</option>
                    <option value="owner" {{ $user->role == 'Owner' ? 'selected' : '' }}>Owner</option>
                    <option value="Pelanggan" {{ $user->role == 'Pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                </select>
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('akun') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>
