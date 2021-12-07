@extends('layouts.app')
@section('title', 'Keranjang')
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
                        <h3 class="card-title">Data Keranjang Anda</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-stripped" id="example1" aria-label="">
                            <thead>
                                <tr>
                                    <th scope="">No.</th>
                                    <th scope="">Foto Produk</th>
                                    <th scope="">Nama Produk</th>
                                    <th scope="">Jumlah</th>
                                    <th scope="">Aksi</th>
                                    <th scope="">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($keranjang) > 0)
                                @foreach ($keranjang as $a)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img width="100px" src="{{ $a->produk->foto_produk }}" alt="fotoproduk"></td>
                                    <td>{{ $a->produk->nama_produk }}</td>
                                    <td>{{ $a->jumlah }}</td>
                                    <td>
                                        <a data-toggle="modal" id="infoKeranjang" data-target="#modal-info{{$a->id}}"
                                            class="btn btn-info"><em class="fas fa-info-circle"></em></a>
                                        <a data-toggle="modal" id="updateKeranjang" data-target="#modal-edit{{$a->id}}"
                                            class="btn btn-success"><em class="fas fa-edit"></em></a>
                                        <a data-toggle="modal" id="deleteKeranjang" data-target="#modal-delete{{$a->id}}"
                                            class="btn btn-danger"><em class="fas fa-trash"></em></a>
                                    </td>
                                    <td><strong>@Rp{{ number_format($a->produk->harga, 0) }}</strong><br>Rp{{ number_format($a->total, 0) }}
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-edit{{$a->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modal-judul">Edit data {{ $a->name }}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route ('keranjang.update', $a->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="id_product">Produk</label>
                                                        <select class="form-control" name="id_product" id="id_product"
                                                            required>
                                                            <option selected hidden>Silahkan pilih produk</option>
                                                            @if (count($produk) > 0)
                                                            @foreach ($produk as $p)
                                                            <option value="{{ $p->id }}"
                                                                {{ $a->id_product == $p->id ? 'selected':'' }}>
                                                                {{ $p->nama_produk }}</option>
                                                            @endforeach
                                                            @else
                                                            <option>Produk belum tersedia!</option>
                                                            @endif

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jumlah">Jumlah</label>
                                                        <input type="number" class="form-control" name="jumlah"
                                                            id="jumlah" min="1" placeholder="Masukkan jumlah!"
                                                            value="{{ $a->jumlah }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="catatan">Catatan</label>
                                                        <textarea class="form-control" name="catatan" id="catatan"
                                                            placeholder="masukkan catatan...">{{ $a->catatan }}</textarea>
                                                    </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modal-info{{$a->id}}">
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
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <div class="modal fade" id="modal-delete{{$a->id}}">
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
                                                <p>Anda yakin menghapus produk tersebut dari keranjang?</p>
                                            </div>
                                            <form action="{{ route('keranjang.destroy', $a->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>

                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                @endforeach
                                <tr>
                                    <td colspan="5"><strong>Total Bayar</strong></td>
                                    <td>Rp<strong>{{ number_format($total, 0) }}</strong></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-register">
                    <em class="fas fa-plus"></em>&nbsp;Tambahkan Data Keranjang Baru</a>
                </button>
                @if (count($keranjang) > 0)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-checkout">
                    <em class="fas fa-check"></em>&nbsp;Checkout</a>
                </button>
                @endif
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<div class="modal fade" id="modal-register">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Masukkan Data Keranjang Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('keranjang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="id_product">Produk</label>
                        <select class="form-control" name="id_product" id="id_product" required>
                            <option selected hidden>Silahkan pilih produk</option>
                            @if (count($produk) > 0)
                            @foreach ($produk as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_produk }}</option>
                            @endforeach
                            @else
                            <option>Produk belum tersedia!</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah" min="1"
                            placeholder="Masukkan jumlah!" required>
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" name="catatan" id="catatan"
                            placeholder="masukkan catatan..."></textarea>
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
<div class="modal fade" id="modal-checkout">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Checkout Sekarang?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice p-3 mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="fas fa-globe"></i> BILLIE BEANS COFFEE SUPPLY.CO
                                                <small class="float-right">Tanggal: {{ date('d/m/Y'); }}</small>
                                            </h4>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            Pengirim
                                            <address>
                                                <strong>Admin</strong><br>
                                                Jalan Puyengan No.25A<br>
                                                KOTA PROBOLINGGO<br>
                                                JAWA TIMUR<br>
                                                081233355174<br>
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            Penerima
                                            <address>
                                                <strong>{{ Auth::user()->name }}</strong><br>
                                                {{ Auth::user()->alamat }}<br>
                                                {{ Auth::user()->city->name }}<br>
                                                {{ Auth::user()->province->name }}<br>
                                                {{ Auth::user()->phone }}<br>
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            <b>No. Pesan #{{ $notrans }}</b><br>
                                            <b>Batas Bayar:</b><br>{{ date('d/M/Y H:i:s', strtotime('+1 day')); }}<br>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="">No.</th>
                                                        <th scope="">Nama Produk</th>
                                                        <th scope="">Jumlah</th>
                                                        <th scope="">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($keranjang as $k)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $k->produk->nama_produk }}</td>
                                                        <td>{{ $k->jumlah }}</td>
                                                        <td><strong>@Rp{{ number_format($k->produk->harga, 0) }}</strong><br>Rp{{ number_format($k->total, 0) }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <p class="lead">Metode Pembayaran:</p>
                                            {{-- <img src="../../dist/img/credit/visa.png" alt="Visa">
                            <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                            <img src="../../dist/img/credit/american-express.png" alt="American Express">
                            <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> --}}

                                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                                Silahkan untuk langsung menghubungi admin <strong>Phone: (+62)
                                                    81233355174</strong>
                                            </p>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-6">
                                            <p class="lead">Ringkasan Pembayaran</p>

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:50%">Subtotal:</th>
                                                        <td>Rp{{ number_format($total, 0); }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Pajak (0%):</th>
                                                        <td>Rp0</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Ongkos Kirim:</th>
                                                        <td>Rp{{ number_format($ongkir,0) }} </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td>Rp{{ number_format($total+$ongkir,0) }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-primary">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
