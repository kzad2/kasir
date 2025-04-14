<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <title>laporan</title>
</head>
<body>

    @include('template.nav')

    <div class="container mt-4">
        <div class="card shadow-lg p-4">
            <h2 class="mb-4 text-center fw-bold text-primary fs-3">
                Laporan Penjualan
            </h2>

            <div class="table-responsive">
                <table id="datatables" class="table table-bordered table-striped mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Nama Menu</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah Terjual</th>
                            <th>Total Harga</th>
                            <th>Laba</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualans as $key => $penjualan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($penjualan->tanggal_transaksi)->format('Y-m-d') }}</td>
                            <td>{{ $penjualan->nama_kategori }}</td>
                            <td>{{ $penjualan->nama_menu }}</td>
                            <td>Rp {{ number_format($penjualan->harga_satuan, 0, ',', '.') }}</td>
                            <td>{{ $penjualan->jumlah }}</td>
                            <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($penjualan->laba, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
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

    <script>
        new DataTable('#datatables', {
            pagingType: "simple_numbers",
            pageLength: 10
        });
    </script>
</body>
</html>
