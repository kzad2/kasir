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

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @include('template.card')
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
