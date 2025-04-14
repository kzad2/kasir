<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bayar Pesanan</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            padding: 30px;
        }
        .container {
            background: white;
            padding: 25px;
            max-width: 500px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="file"],
        button {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn-submit {
            background-color: #28a745;
            color: white;
            border: none;
        }
        .alert {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload Bukti Pembayaran</h2>

        @if (session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- <form action="{{ route('pelanggan.prosesbayar', $detailTransaksi->id) }}" method="POST" enctype="multipart/form-data"> --}}
            @csrf
            {{-- <label for="bukti_transfer">Upload Bukti Transfer (jpg/png/jpeg):</label>
            <input type="file" name="bukti_transfer" id="bukti_transfer" required> --}}
            <button class="btn-submit" id="pay-button">Proses Pembayaran</button>
        {{-- </form> --}}
    </div>

    @include('template.footer')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY')}}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
          // SnapToken acquired from previous step
          snap.pay( '{{ $snapToken }}', {
            // Optional
            onSuccess: function(result){
                console.log("jawa");
                window.location.href = "{{ route('pelanggan.sukses', ['id' => $detailTransaksi->id,'orderId' => $orderId]) }}";
            },
            // Optional
            onPending: function(result){
              /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result){
              /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
          });
        };
      </script>
</body>
</html>



