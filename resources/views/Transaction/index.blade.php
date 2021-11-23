@extends('layouts.app')
@section('title', 'Transaksi')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Transaksi Anda</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-stripped" id="example1" aria-label="">
                            <thead>
                                <tr>
                                    <th scope="">No.</th>
                                    <th scope="">ID Transaksi</th>
                                    <th scope="">Tanggal Pemesanan</th>
                                    <th scope="">Total Pembayaran</th>
                                    <th scope="">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($transaksi) > 0)
                                @foreach ($transaksi as $a)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $a->id_transaksi }}</td>
                                    <td>{{ $a->created_at }}</td>
                                    <td>Rp{{ number_format($a->total_bayar,0) }}</td>
                                    <td>
                                        <a data-toggle="modal" id="infoTransaksi" data-target="#modal-info{{$a->id}}"
                                            class="btn btn-info"><em class="fas fa-info-circle"></em></a>
                                    </td>
                                </tr>
                                {{-- <div class="modal fade" id="modal-info{{$a->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modal-judul">Detail {{ $a->name }}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="namaproduk">Nama Produk</label>
                                                    <p>{{ $a->produk->nama_produk }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fotoprofil">Foto Produk</label><br>
                                                    <img width="150px" src="{{ $a->produk->foto_produk }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Jumlah Pemesanan</label>
                                                    <p>{{ $a->jumlah }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="level">Catatan</label>
                                                    <p>{{ $a->catatan }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="dibuat">Dibuat pada</label><br>
                                                    <p>{{ $a->created_at }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="diupdate">Terakhir update</label><br>
                                                    <p>{{ $a->updated_at }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>
</div>
@endsection
