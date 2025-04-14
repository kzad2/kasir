<style>
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }
    .card img {
        height: 180px;
        object-fit: cover;
    }
</style>

<!-- Makanan Section -->
<div class="container p-3">
    <h2 id="makanan" class="text-center" style="color: green">Makanan</h2><br>
    <div class="row">
        @foreach ($makanan as $item)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <img src="{{ asset('img/' . $item->foto) }}" class="card-img-top" alt="{{ $item->nama }}">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold text-success">{{ $item->nama }}</h5>
                    <p class="card-text text-muted">{{ $item->deskripsi }}</p>

                    {{-- <form action="{{ route('pelanggan.postKeranjang', $item->id,$meja->id) }}"> --}}
                    <form action="#">
                        @csrf
                        <div class="d-flex justify-content-center gap-2">
                            <a class="btn btn-outline-primary px-3" href="{{ route('detail', $item->id) }}">Detail</a>
                            <button type="submit" class="btn btn-success d-flex align-items-center gap-2 px-3">
                                <i class="bi bi-cart-plus"></i> Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Minuman Section -->
<hr>
<div class="container">
    <h2 id="minuman" class="text-center" style="color: green">Minuman</h2><br>
    <div class="row">
        @foreach ($minuman as $item)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <img src="{{ asset('img/' . $item->foto) }}" class="card-img-top" alt="{{ $item->nama }}">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold text-success">{{ $item->nama }}</h5>
                    <p class="card-text text-muted">{{ $item->deskripsi }}</p>

                       {{-- <form action="{{ route('pelanggan.postKeranjang',  ['meja' => $meja->id,'menu'=>$item->id]) }}" method="POST"> --}}
                        @csrf
                        <!-- Jumlah input & label (horizontal) -->
                        {{-- <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                            <label for="banyak-{{ $item->id }}" class="form-label m-0"><strong>Jumlah:</strong></label>
                            <input type="number" name="banyak" id="banyak-{{ $item->id }}" class="form-control w-50 text-center" value="1" min="1" required>
                        </div> --}}

                        <!-- Tombol aksi -->
                        <div class="d-flex justify-content-center gap-2">
                            <a class="btn btn-outline-primary px-3" href="{{ route('detail', $item->id) }}">Detail</a>
                            <button type="submit" class="btn btn-success d-flex align-items-center gap-2 px-3">
                                <i class="bi bi-cart-plus"></i> Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
