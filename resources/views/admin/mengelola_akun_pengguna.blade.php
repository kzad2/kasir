<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>mengelola akun pengguna</title>
</head>
<body>
@include('template.nav')

<div class="container mt-4">
    <form action="{{ route('pengguna.tambah') }}" method="POST" enctype="multipart/form-data">
        <div class="card shadow-lg p-4">
            <h2 class="mb-4 text-center text-primary">Kelola Akun Pengguna</h2>

            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('pengguna.tambah') }}" class="btn btn-success">
                    <i class="bi bi-person-plus"></i> Tambah Pengguna
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td class="text-center ps-3">{{ $item->name }}</td>
                                <td class="text-start ps-3">{{ $item->email }}</td>
                                <td><span class="badge bg-info text-dark">{{ ucfirst($item->role) }}</span></td>
                                <td>
                                    <a href="{{ route('pengguna.ubah', $item->id) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('pengguna.hapus', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>

</body>
</html>

