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
                                </tr>
                            </thead>
                            <tbody>
                                @if ($keranjang)
                                @foreach ($keranjang as $a)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img width="100px" src="{{ asset('storage/'.$a->produk->foto_produk) }}" alt="fotoproduk"></td>
                                    <td>{{ $a->produk->nama_produk }}</td>
                                    <td>{{ $a->jumlah }}</td>
                                    <td>
                                        <a data-toggle="modal" id="infoKeranjang" data-target="#modal-info{{$a->id}}"
                                            class="btn btn-info"><em class="fas fa-info-circle"></em></a>
                                        <a data-toggle="modal" id="updateKeranjang" data-target="#modal-edit{{$a->id}}"
                                            class="btn btn-success"><em class="fas fa-edit"></em></a>
                                        <form action="{{ route('keranjang.destroy', $a->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><em class="fas fa-trash"></em></button>
                                        </form>
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
                                                        <select class="form-control" name="id_product" id="id_product" required>
                                                            <option selected hidden>Silahkan pilih produk</option>
                                                            @if (count($produk) > 0)
                                                                @foreach ($produk as $p)
                                                                    <option value="{{ $p->id }}" {{ $a->id_product == $p->id ? 'selected':'' }}>{{ $p->nama_produk }}</option>
                                                                @endforeach
                                                            @else
                                                                <option>Produk belum tersedia!</option>
                                                            @endif

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jumlah">Jumlah</label>
                                                        <input type="number" class="form-control" name="jumlah" id="jumlah" min="1" placeholder="Masukkan jumlah!" value="{{ $a->jumlah }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="catatan">Catatan</label>
                                                        <textarea class="form-control" name="catatan" id="catatan" placeholder="masukkan catatan...">{{ $a->catatan }}</textarea>
                                                    </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
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
                                                    <img width="150px" src="{{ asset('storage/'.$a->produk->foto_produk) }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Jumlah Pemesanan</label>
                                                    <p>{{ $a->jumlaj }}</p>
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
                                @endforeach
                                @else
                                Tidak ada data
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-register">
                    <em class="fas fa-plus"></em>&nbsp;Tambahkan Data Keranjang Baru</a>
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-checkout">
                    <em class="fas fa-check"></em>&nbsp;Checkout</a>
                </button>
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
                        <input type="number" class="form-control" name="jumlah" id="jumlah" min="1" placeholder="Masukkan jumlah!" required>
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" name="catatan" id="catatan" placeholder="masukkan catatan..."></textarea>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
