<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Menu - {{ $item->name }}</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .navbar-nav .nav-link:not(.btn) {
            color: white !important;
            padding: 0.5rem 1rem;
            position: relative;
            transition: color 0.3s ease;
            z-index: 1;
            font-weight: 500;
            font-size: 1rem;
            text-align: center;
            border-radius: 999px;
        }

        .navbar-nav .nav-link:not(.btn)::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scaleX(0);
            width: calc(100% + 20px);
            height: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 999px;
            z-index: -1;
            transition: transform 0.3s ease, opacity 0.3s ease;
            opacity: 0;
        }

        .navbar-nav .nav-link:not(.btn):hover::before {
            transform: translate(-50%, -50%) scaleX(1);
            opacity: 1;
        }

        .navbar-nav {
            gap: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .navbar .navbar-brand {
            font-weight: 600;
            font-size: 1.25rem;
        }

        .dropdown-menu {
            font-size: 0.95rem;
        }

        @media (max-width: 991.98px) {
            .navbar-nav {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* Detail Page Styling */
        body {
            background-color: #f8f9fa;
        }

        .main-container {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            width: 100%;
            margin: 40px auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .content-wrapper {
            display: flex;
            justify-content: center;
        }

        .menu-content {
            display: flex;
            max-width: 900px;
            width: 100%;
        }

        .image-section {
            width: 45%;
            padding-right: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .detail-section {
            width: 55%;
            padding-left: 30px;
        }

        .menu-img {
            width: 100%;
            max-height: 350px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #e67e22;
            margin: 15px 0;
        }

        .btn-keranjang {
            background-color: #198754;
            color: white;
            padding: 10px 20px;
        }

        .btn-kembali {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
        }

        .emoji-container {
            text-align: center;
            margin-top: 15px;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .container {
                padding: 25px;
            }

            .menu-content {
                flex-direction: column;
            }

            .image-section,
            .detail-section {
                width: 100%;
                padding: 0;
            }

            .detail-section {
                margin-top: 30px;
            }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid d-flex align-items-center">
        <!-- Brand -->
        <a class="navbar-brand order-1" href="{{ route('home') }}">kasirKU</a>

        <!-- Toggle Mobile -->
        <button class="navbar-toggler order-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav Tengah -->
        <div class="collapse navbar-collapse w-100 order-2" id="navbarNav">
            @auth
            <ul class="navbar-nav mx-auto d-flex align-items-center gap-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Kategori
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#makanan">Makanan</a></li>
                        <li><a class="dropdown-item" href="#minuman">Minuman</a></li>
                    </ul>
                </li>

                @if(auth()->user()->role == 'admin')
                    <li class="nav-item"><a class="nav-link" href="{{ route('mengelola_data_menu') }}">Mengelola Data Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('akun') }}">Mengelola Akun</a></li>
                @elseif(auth()->user()->role == 'kasir')
                    <li class="nav-item"><a class="nav-link" href="{{ route('history_transaksi') }}">History Transaksi</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('kelolameja') }}">Mengelola Meja</a></li>
                @elseif(auth()->user()->role == 'chef')
                    <li class="nav-item"><a class="nav-link" href="{{ route('list_daftar_pemesanan') }}">List Daftar Pemesanan</a></li>
                @elseif(auth()->user()->role == 'owner')
                    <li class="nav-item"><a class="nav-link" href="{{ route('melihat_laporan_penjualan') }}">Melihat Laporan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('chart') }}">Grafik</a></li>
                @elseif(auth()->user()->role == 'pelanggan')
                    <li class="nav-item"><a class="nav-link" href="#">Pesanan Saya</a></li>
                @endif

                @if(auth()->user()->role == 'kasir' || auth()->user()->role == 'pelanggan')
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center text-white gap-2" href="{{ route('pelanggan.keranjang') }}">
                        <i class="bi bi-cart4" style="font-size: 1.3rem;"></i>
                        <span class="fw-semibold">Keranjang</span>
                    </a>
                </li>
                @endif
            </ul>
            @endauth
        </div>

        <!-- Login / Logout -->
        <ul class="navbar-nav ms-auto d-flex align-items-center gap-3 order-3">
            @auth
                <li class="nav-item">
                    <a class="nav-link btn btn-danger d-flex align-items-center gap-2 text-white px-3" href="{{ route('logout') }}">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link btn btn-primary d-flex align-items-center gap-2 text-white px-3" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Login</span>
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<div class="main-container">
    <div class="container">
        <div class="content-wrapper">
            <div class="menu-content">
                <!-- Left Column - Image and Emoji -->
                <div class="image-section">
                    <img class="menu-img" src="{{ asset('img/' . $item->foto) }}" alt="{{ $item->nama }}">
                    <div class="emoji-container">
                        <h2>🍕🍔🍣🍩🥗🍷🍹</h2>
                    </div>
                </div>

                <!-- Right Column - Details -->
                <div class="detail-section">
                    <h1 class="mb-3">{{ $item->nama }}</h1>
                    <p class="price">Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                    <p><strong>Kategori:</strong> {{ $item->kategori->nama ?? '-' }}</p>
                    <p><strong>Deskripsi:</strong> {{ $item->deskripsi }}</p>
                    {{-- @dd($item) --}}
                    <form action="{{ route('pelanggan.postKeranjang',  ['meja' => $meja->id,'menu'=>$item->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="banyak" class="form-label"><strong>Jumlah:</strong></label>
                            <input type="number" name="banyak" id="banyak" class="form-control d-inline-block w-auto ms-2" value="1" min="1" required>
                        </div>

                        <div class="d-flex flex-wrap gap-3">
                            <button type="submit" class="btn btn-keranjang">Tambah ke Keranjang</button>
                            <a href="{{ route('home') }}" class="btn btn-kembali">Kembali ke Menu</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
