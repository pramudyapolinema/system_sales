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
                        <h3 class="card-title">Data Seluruh Transaksi</h3>
                    </div>
                    <!-- ./card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-stripped table-hover" id="example1" aria-label="">
                            <thead>
                                <tr>
                                    <th scope="">No.</th>
                                    <th scope="">ID Transaksi</th>
                                    <th scope="">Tanggal Pemesanan</th>
                                    <th scope="">Total Pembayaran</th>
                                    <th scope="">Status</th>
                                    <th>Resi</th>
                                    <th scope="">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($transaksi) > 0)
                                @foreach ($transaksi as $a)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $a->id_transaksi }}</td>
                                    <td>{{ $a->created_at }}</td>
                                    <td>Rp{{ number_format($a->total_bayar,0) }}</td>
                                    <td>{{ $a->status }}</td>
                                    <td>{{ $a->resi }}</td>
                                    <td>
                                        @switch(auth()->user()->level)
                                            @case('admin')
                                                @switch($a->status)
                                                    @case('Menunggu')
                                                    <a href="{{ route('konfirmasipembayaran', $a->id) }}" id="konfirmasipembayaran"
                                                        class="btn btn-warning"><em class="fas fa-check-circle"></em></a>
                                                    <a data-toggle="modal" data-target="#modal-cancel{{$a->id}}" id="pembatalan" class="btn btn-danger"><em class="fas fa-times"></em></a>
                                                    @break
                                                    @case('Dibayar')
                                                    <a data-toggle="modal" data-target="#modal-resi{{$a->id}}" id="inputresi"
                                                        class="btn btn-primary"><em class="fas fa-truck"></em></a>
                                                    <a href="" id="pembatalan" class="btn btn-danger"><em class="fas fa-times"></em></a>
                                                    @break

                                                @endswitch
                                                <a data-toggle="modal" id="infoTransaksi" data-target="#modal-info{{$a->id}}"
                                                    class="btn btn-info"><em class="fas fa-info-circle"></em></a>
                                            @break
                                            @case('pelanggan')
                                                @switch($a->status)
                                                    @case('Menunggu')
                                                    <a data-toggle="modal" data-target="#modal-cancel{{$a->id}}" id="pembatalan" class="btn btn-danger"><em class="fas fa-times"></em></a>
                                                    @break
                                                    @case('Dikirim')
                                                    <a data-toggle="modal" data-target="#modal-selesai{{ $a->id }}" id="selesaikantransaksi"
                                                    class="btn btn-success"><em class="fas fa-check-circle"></em></a>
                                                    @break
                                                @endswitch
                                            <a data-toggle="modal" id="infoTransaksi" data-target="#modal-info{{$a->id}}"
                                                class="btn btn-info"><em class="fas fa-info-circle"></em></a>
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                                <tr class="expandable-body">
                                    <td colspan="7">
                                        <p>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Produk</th>
                                                        <th>Gambar</th>
                                                        <th>Jumlah</th>
                                                        <th>Berat Total</th>
                                                        <th>Harga Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($produktransaksi as $p)
                                                    @if ($a->id_transaksi == $p->id_transaksi)
                                                    <tr>
                                                        <td>{{ $p->produk->nama_produk }}</td>
                                                        <td><img width="100px" src="{{ $p->produk->foto_produk }}"></td>
                                                        <td>{{ $p->jumlah }}</td>
                                                        <td><strong>{{ '@'. $p->produk->berat . 'gr' }} x
                                                                {{ $p->jumlah }}</strong><br>{{ $p->total_berat .'gr' }}
                                                        </td>
                                                        <td><strong>{{'@Rp'. number_format($p->produk->harga,0) }} x
                                                                {{ $p->jumlah }}</strong><br>Rp{{ number_format($p->total,0) }}
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </p>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-cancel{{$a->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modal-judul">Batalkan transaksi {{ $a->id_transaksi }}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda yakin ingin membatalkan transaksi {{ $a->id_transaksi }}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <a href="{{ route('cancelTransaksi', $a->id) }}" type="submit" class="btn btn-primary">Submit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(auth()->user()->level == 'admin')
                                <div class="modal fade" id="modal-resi{{$a->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modal-judul">Input resi transaksi {{ $a->id_transaksi }}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('updateResi', $a->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="resi">Resi</label>
                                                        <input type="text" class="form-control" name="resi" id="resi" placeholder="Masukkan Resi">
                                                    </div>

                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
</div>
@endsection
