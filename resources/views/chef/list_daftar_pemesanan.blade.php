<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            min-height: 100%;
        }
        .card-header {
            font-size: 1.2rem;
            padding: 10px 0;
        }
        .card-body {
            font-size: 0.95rem;
        }
        .btn-success {
            font-size: 0.9rem;
            padding: 6px 12px;
        }
    </style>
</head>
<body>

    @include('template.nav')

    <div class="container mt-5">
        <h2 class="text-center fw-bold mb-4">Daftar Pesanan</h2>

        <div class="row justify-content-center g-3">
            @foreach ($detailTransaksis as $trx)
                <div class="col-md-4 col-sm-6">
                    <div class="card shadow-sm">
                        <div class="card-header text-white text-center fw-bold bg-{{ $trx->meja->id == 1 ? 'danger' : ($trx->meja->id == 2 ? 'success' : 'primary') }}">
                            MEJA NO {{ $trx->meja->nomor_meja }}
                        </div>
                        <div class="card-body text-center">
                            <div class="mb-2">
                                {{-- <strong>
                                    {{ $trx->waktu_pesan ? \Carbon\Carbon::parse($trx->waktu_pesan)->format('H:i') : '' }},
                                    {{ $trx->nama_pemesan }}
                                </strong> --}}
                                <h4>pesanan</h4>
                            </div>
                            <p class="fw-semibold mb-2">{{ ucfirst($trx->tipe) }}</p>
                                <li>
                                    {{ $trx->qty }}x
                                    {{ $trx->menu->nama }}
                                    {{-- @if ($item->keterangan)
                                        <div class="text-muted small">{{ $item->keterangan }}</div>
                                    @endif --}}
                                    </li>
                            {{-- @endforeach --}}
                            <form action="{{ route('transaksi.selesai', $trx->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-success mt-3">Selesai Dibuat</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
