<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .table img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.3rem 0.75rem;
        }

        .btn-group .btn.active {
            background-color: #4f4f4f;
            color: white;
        }

    </style>
</head>
<body>
    @include('template.nav')

    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center text-primary mb-4">Daftar Menu</h2>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Tombol Filter -->
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div class="btn-group" role="group" aria-label="Filter Kategori">
                    <button class="btn btn-outline-grey active" id="btnAll">Semua</button>
                    <button class="btn btn-outline-grey" id="btnMakanan">Makanan</button>
                    <button class="btn btn-outline-grey" id="btnMinuman">Minuman</button>
                </div>
                <a href="{{ route('tambah_menu') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Menu
                </a>
            </div>

            <!-- Tabel Menu -->
            <div class="table-responsive">
                <table id="datatables" class="table table-striped table-bordered align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $item)
                        <tr class="kategori-{{ strtolower($item->kategori->nama ?? 'lain') }}">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ asset('img/' . $item->foto) }}" alt="{{ $item->nama }}">
                            </td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kategori->nama ?? 'Tidak Diketahui' }}</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('edit_menu', $item->id) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('hapus_menu', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus menu ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const table = new DataTable('#datatables', {
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Berikutnya"
                },
                zeroRecords: "Tidak ada data ditemukan"
            }
        });

        // Filter kategori
        $('#btnAll').on('click', function () {
            $('tr[class^="kategori-"]').show();
            $('.btn-group button').removeClass('active');
            $(this).addClass('active');
        });

        $('#btnMakanan').on('click', function () {
            $('tr[class^="kategori-"]').hide();
            $('.kategori-makanan').show();
            $('.btn-group button').removeClass('active');
            $(this).addClass('active');
        });

        $('#btnMinuman').on('click', function () {
            $('tr[class^="kategori-"]').hide();
            $('.kategori-minuman').show();
            $('.btn-group button').removeClass('active');
            $(this).addClass('active');
        });
    </script>
</body>
</html>
