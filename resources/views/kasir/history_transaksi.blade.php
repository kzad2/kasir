<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Transaksi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
</head>
<body>
    @include('template.nav')

    <div class="container mt-4">
        <h2 class="mb-4 text-center">Histori Transaksi</h2>

        <div class="table-responsive">
            <table class="table table-striped" id="transaksiTable" style="width: 100%;">
                <thead class="table-dark">
                    <tr>
                        <th>Waktu Transaksi</th>
                        <th>Kode</th>
                        <th>Total Harga</th>
                        <th>Metode Pembayaran</th>
                        <th>Issuer</th>
                        <th>Status Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $trx)
                        @php
                            $orders = $trx->detailTransaksis->map(function($item) {
                                return [
                                    'nama' => $item->menu->nama ?? 'Tidak diketahui',
                                    'qty' => $item->jumlah,
                                    'harga' => $item->harga,
                                ];
                            });
                        @endphp
                        <tr data-bs-toggle="modal" data-bs-target="#detailModal"
                            data-kode="{{ $trx->kode }}"
                            data-total="{{ $trx->totalharga }}"
                            data-metode="{{ $trx->payment_type }}"
                            data-waktu="{{ $trx->transaction_time }}"
                            data-issuer="{{ $trx->issuer }}"
                            data-status="{{ $trx->status_pesanan }}"
                            data-order='{{ json_encode($orders) }}'>
                            <td>{{ $trx->transaction_time }}</td>
                            <td>{{ $trx->kode }}</td>
                            <td>Rp {{ number_format($trx->totalharga, 0, ',', '.') }}</td>
                            <td>{{ $trx->payment_type }}</td>
                            <td>{{ $trx->issuer }}</td>
                            <td>{{ ucfirst($trx->status_pesanan) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Detail Transaksi -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6><strong>Waktu:</strong> <span id="modalWaktu"></span></h6>
                    <h6><strong>Kode Transaksi:</strong> <span id="modalKode"></span></h6>
                    <h6><strong>Status Pesanan:</strong> <span id="modalStatus"></span></h6>
                    <h6><strong>Issuer:</strong> <span id="modalIssuer"></span></h6>

                    <h5 class="mt-3">Order Detail</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Item</th>
                                <th>Qty</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody id="orderDetailBody"></tbody>
                    </table>

                    <h5 class="mt-3">Payment Detail</h5>
                    <p><strong>Metode Pembayaran:</strong> <span id="modalMetode"></span></p>
                    <p><strong>Total Harga:</strong> Rp <span id="modalTotal"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#transaksiTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });

            $('#transaksiTable tbody').on('click', 'tr', function () {
                const data = $(this).data();

                $('#modalKode').text(data.kode);
                $('#modalWaktu').text(data.waktu);
                $('#modalStatus').text(data.status);
                $('#modalIssuer').text(data.issuer);
                $('#modalMetode').text(data.metode);
                $('#modalTotal').text(new Intl.NumberFormat('id-ID').format(data.total));

                const orders = JSON.parse(data.order);
                $('#orderDetailBody').empty();
                orders.forEach(order => {
                    $('#orderDetailBody').append(`
                        <tr>
                            <td>${order.nama}</td>
                            <td>${order.qty}</td>
                            <td>Rp ${new Intl.NumberFormat('id-ID').format(order.harga)}</td>
                        </tr>
                    `);
                });
            });
        });
    </script>

</body>
</html>
