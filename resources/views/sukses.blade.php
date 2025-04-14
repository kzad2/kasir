@extends('app.layouts')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Kelola Meja</h2>

    <div class="row justify-content-center">
        @php
            $mejas = [
                ['nomor_meja' => '01', 'status' => 'kosong'],
                ['nomor_meja' => '02', 'status' => 'terisi'],
                ['nomor_meja' => '03', 'status' => 'kosong'],
                ['nomor_meja' => '04', 'status' => 'terisi'],
                ['nomor_meja' => '05', 'status' => 'kosong'],
                ['nomor_meja' => '06', 'status' => 'terisi'],
            ];
        @endphp

        @foreach($mejas as $m)
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card text-center shadow-lg border-0" style="border-radius: 10px;">
                <div class="card-header text-white" 
                    style="background-color: {{ $m['status'] == 'kosong' ? '#28a745' : '#dc3545' }}; font-size: 18px;">
                    <strong>Meja {{ $m['nomor_meja'] }}</strong>
                </div>
                <div class="card-body d-flex flex-column align-items-center">
                    <img src="{{ $m['status'] == 'kosong' ? 'https://cdn-icons-png.flaticon.com/512/190/190411.png' : 'https://cdn-icons-png.flaticon.com/512/1828/1828778.png' }}" 
                        alt="Status Meja" class="img-fluid mb-3" style="width: 60px;">
                    
                    <h5>
                        <span class="badge {{ $m['status'] == 'kosong' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($m['status']) }}
                        </span>
                    </h5>
                </div>
                <div class="card-footer bg-white">
                    <button class="btn btn-outline-primary btn-sm">Edit</button>
                    <button class="btn btn-outline-danger btn-sm">Hapus</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection