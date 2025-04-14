<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .header { background: #333; color: white; padding: 15px; display: flex; justify-content: space-between; align-items: center; }
        .menu-container { display: flex; flex-wrap: wrap; justify-content: center; padding: 20px; }
        .menu-card { background: white; width: 220px; margin: 15px; padding: 15px; border-radius: 10px; text-align: center; }
        .menu-card img { width: 100%; border-radius: 10px; }
        .btn-container { display: flex; flex-direction: column; gap: 10px; margin-top: 10px; }
        .btn { padding: 10px; border: none; border-radius: 5px; cursor: pointer; }
        .btn-keranjang { background-color: #28a745; color: white; }
        .btn-detail { background-color: #007bff; color: white; }
        .cart-container { cursor: pointer; display: flex; align-items: center; gap: 10px; }
        .cart-container img { width: 24px; height: 24px; }
    </style>
</head>
<body>
    @include('template.nav')
    {{-- <div class="header">
        <h1>Daftar Menu</h1>
        <div class="cart-container" onclick="bukaKeranjang()">
            <img src="{{ asset('images/cart-icon.png') }}" alt="Keranjang">
            <span>Keranjang: <span id="cart-count">0</span></span>
        </div>
    </div> --}}

    @include('template.card')
    {{-- <div class="menu-container">
        @php
            $menus = [
                ["id" => 1, "name" => "Sate Ayam", "desc" => "Sate ayam dengan bumbu kacang khas.", "img" => "sate-ayam.jpg"],
                ["id" => 2, "name" => "Nasi Goreng", "desc" => "Nasi goreng spesial dengan telur dadar.", "img" => "nasi-goreng.jpg"],
                ["id" => 3, "name" => "Ayam Bakar", "desc" => "Ayam bakar dengan sambal terasi pedas.", "img" => "ayam-bakar.jpg"],
                ["id" => 4, "name" => "Mie Goreng", "desc" => "Mie goreng spesial dengan topping ayam.", "img" => "mie-goreng.jpg"],
                ["id" => 5, "name" => "Soto Ayam", "desc" => "Soto ayam dengan kuah bening dan nasi.", "img" => "soto-ayam.jpg"],
                ["id" => 6, "name" => "Gado-Gado", "desc" => "Salad sayur khas Indonesia dengan bumbu kacang.", "img" => "gado-gado.jpg"],
                ["id" => 7, "name" => "Rendang", "desc" => "Rendang daging sapi khas Padang.", "img" => "rendang.jpg"],
                ["id" => 8, "name" => "Bakso", "desc" => "Bakso sapi dengan kuah kaldu segar.", "img" => "bakso.jpg"],
                ["id" => 9, "name" => "Pempek", "desc" => "Pempek Palembang dengan cuko pedas.", "img" => "pempek.jpg"],
                ["id" => 10, "name" => "Nasi Uduk", "desc" => "Nasi uduk dengan lauk ayam goreng.", "img" => "nasi-uduk.jpg"],
                ["id" => 11, "name" => "Rawon", "desc" => "Rawon daging sapi dengan kuah hitam khas Jawa Timur.", "img" => "rawon.jpg"],
                ["id" => 12, "name" => "Tahu Tek", "desc" => "Tahu goreng dengan bumbu kacang dan lontong.", "img" => "tahu-tek.jpg"],
                ["id" => 13, "name" => "Ikan Bakar", "desc" => "Ikan bakar dengan sambal dan lalapan.", "img" => "ikan-bakar.jpg"],
                ["id" => 14, "name" => "Sop Buntut", "desc" => "Sop buntut sapi dengan kuah gurih.", "img" => "sop-buntut.jpg"],
                ["id" => 15, "name" => "Capcay", "desc" => "Capcay sayur dengan kuah kental.", "img" => "capcay.jpg"],
                ["id" => 16, "name" => "Gulai Kambing", "desc" => "Gulai kambing khas Padang.", "img" => "gulai-kambing.jpg"],
                ["id" => 17, "name" => "Tongseng", "desc" => "Tongseng kambing pedas.", "img" => "tongseng.jpg"],
                ["id" => 18, "name" => "Bebek Goreng", "desc" => "Bebek goreng dengan sambal korek.", "img" => "bebek-goreng.jpg"],
                ["id" => 19, "name" => "Lontong Sayur", "desc" => "Lontong dengan kuah sayur labu.", "img" => "lontong-sayur.jpg"],
                ["id" => 20, "name" => "Es Teler", "desc" => "Es teler dengan kelapa muda dan alpukat.", "img" => "es-teler.jpg"]
            ];
        @endphp

        @foreach ($data as $item)
            <div class="menu-card">
                <img src="{{ asset('images/' . $item['img']) }}" alt="{{ $item['name'] }}">
                <h3>{{ $item['name'] }}</h3>
                <p>{{ $item['desc'] }}</p>
                <div class="btn-container">
                    <button class="btn btn-detail" onclick="window.location.href='/detail?id={{ $item['id'] }}'">Detail</button>
                    <button class="btn btn-keranjang" onclick="tambahKeKeranjang('{{ $item['name'] }}')">Tambah ke Keranjang</button>
                </div>
            </div>
        @endforeach
    </div> --}}

    @include('template.footer')

    <script>
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        updateCartCount();

        function tambahKeKeranjang(item) {
            cart.push(item);
            localStorage.setItem("cart", JSON.stringify(cart));
            updateCartCount();
        }

        function updateCartCount() {
            document.getElementById("cart-count").textContent = cart.length;
        }
    </script>

</body>
</html>
