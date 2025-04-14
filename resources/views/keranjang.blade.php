<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1b1919;
            color: white;
        }


        .payment-option {
            background-color: #28a745;
            padding: 10px 20px;
            font-size: 18px;
            margin: 5px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .payment-option:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    @include('template.nav')

    <div class="container mt-4">
        <h2 class="text-center fw-bold text-secondary">Pesanan</h2>
        <hr>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @forelse ($detailTransaksis as $item)
            <div class="card shadow mb-3 text-dark">
                <div class="row g-0">
                    <div class="col-md-2 p-2">
                        {{-- @dd($item->menu->foto) --}}
                        @if ($item->menu && $item->menu->foto)
                        <img src="{{ asset('img/' . $item->menu->foto) }}" alt="Foto Produk" class="img-thumbnail">
                        @else
                            <div class="bg-secondary text-white text-center p-3 rounded">Foto tidak tersedia</div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            @if ($item->menu)
                                <h5 class="card-title fw-bold">{{ $item->menu->nama }}</h5>
                                <p class="card-text">Harga: Rp {{ number_format($item->menu->harga, 0, ',', '.') }}</p>
                            @else
                                <p class="text-danger fw-bold">Menu tidak ditemukan</p>
                            @endif
                            <p>Qty: {{ $item->qty }}</p>
                            <p>Total Harga: Rp {{ number_format($item->totalharga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex flex-column align-items-center justify-content-center gap-2 p-2">
                        <a href="{{ route('pelanggan.bayar', $item->id) }}" class="btn btn-outline-success w-100 rounded-pill shadow-sm">
                            <i class="bi bi-cash-coin me-1"></i> Bayar
                        </a>

                        <form action="{{ route('pelanggan.hapusItem', $item->id) }}" method="POST" class="w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100 rounded-pill shadow-sm">
                                <i class="bi bi-trash3 me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning text-center text-dark">Pesanan masih kosong.</div>
        @endforelse

        @if(count($detailTransaksis) > 0)
            <div class="card mt-4 text-dark">
                <div class="card-body">
                    <h4 class="fw-bold">Ringkasan Belanja</h4>
                    <hr class="bg-secondary">
                    <p class="fs-5">Total Semua:
                        <span class="fw-bold">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </p>
                    <a href="{{ route('pelanggan.bayarSemua') }}" class="btn btn-success w-100 mt-2">Bayar Semua</a>

                    <form action="{{ route('pelanggan.hapusSemua') }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">Hapus Semua</button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
