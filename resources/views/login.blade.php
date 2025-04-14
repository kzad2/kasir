<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            /* background-image: url('https://static.republika.co.id/uploads/images/inpicture_slide/bisnis-cuci-mobil-_140801183353-738.jpg'); Ganti dengan path gambar Anda */
            background-size: cover; /* Mengatur gambar agar menutupi seluruh latar belakang */
            background-position: center; /* Memusatkan gambar */
            font-family: 'Arial', sans-serif;
            height: 100vh; /* Mengatur tinggi body agar memenuhi viewport */
            display: flex; /* Menggunakan flexbox untuk memusatkan konten */
            justify-content: center; /* Memusatkan secara horizontal */
            align-items: center; /* Memusatkan secara vertikal */
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.9); /* Menambahkan latar belakang putih transparan */
        }
        .card-title {
            font-size: 24px;
            font-weight: bold;
            color: #343a40;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .btn-primary {
            background-color: #288ca7;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
        }
        .btn-primary:hover {
            background-color: #218838;
        }
        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card w-50 mx-auto p-4">
            <h5 class="card-title text-center">Login</h5>
            <form action="{{ route('postlogin') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" required name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" required name="password">
                    @if (Session::has('status'))
                        <div class="error-message">{{ Session::get('status') }}</div>
                    @endif
                </div>
                <button class="btn btn-primary w-100" type="submit">Login</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>