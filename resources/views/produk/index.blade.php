@extends('layouts.app')
@section('title', 'Produk')
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
                        <h3 class="card-title">Data Seluruh Produk</h3>
                      </div>
                    <div class="card-body">
                        <table class="table table-bordered table-stripped" id="example1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Foto</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($produk)
                                @foreach ($produk as $a)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $a->nama_produk }}</td>
                                    <td>{{ $a->deskripsi }}</td>
                                    <td><img width="100px" src="{{ $a->foto_produk }}"></td>
                                    <td>Rp{{ number_format($a->harga, 0) }}</td>
                                    <td>
                                        <a data-toggle="modal" id="infoProduk" data-target="#modal-info{{$a->id}}"
                                            class="btn btn-info"><i class="fas fa-info-circle"></i></a>
                                        @if (auth()->user()->level == 'admin')
                                            <a data-toggle="modal" id="updateProduk" data-target="#modal-edit{{$a->id}}"
                                                class="btn btn-success"><i class="fas fa-edit"></i></a>
                                            <a data-toggle="modal" id="deleteProduk" data-target="#modal-delete{{$a->id}}"
                                                class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        @else
                                        <a data-toggle="modal" id="updateProduk" data-target="#modal-add-to-cart{{$a->id}}"
                                            class="btn btn-success"><i class="fas fa-cart-plus"></i></a>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-edit{{$a->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modal-judul">Edit data {{ $a->nama_produk }}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route ('produk.update', $a->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="nama_produk">Nama Produk</label>
                                                        <input type="text" class="form-control" name="nama_produk" id="nama_produk"
                                                            value="{{ $a->nama_produk }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="deskripsi">Deskripsi</label>
                                                        <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi produk">{{ $a->deskripsi }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="harga">Harga</label>
                                                        <input type="number" class="form-control" name="harga" id="harga" value="{{ $a->harga }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="berat">Berat (gram)</label>
                                                        <input type="number" class="form-control" name="berat" id="berat" value="{{ $a->berat }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="foto_produk">Foto Produk</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="foto_produk" name="foto_produk">
                                                                <label class="custom-file-label" for="foto_produk">Upload
                                                                    foto produk</label>
                                                            </div>
                                                        </div>
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
                                                <h4 class="modal-title" id="modal-judul">Detail {{ $a->nama_produk }}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nama_produk">Nama Produk</label>
                                                    <p>{{ $a->nama_produk }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="deskripsi">Deskripsi</label>
                                                    <p>{{ $a->deskripsi }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga">Harga</label>
                                                    <p>Rp{{ number_format($a->harga, 0) }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="berat">Berat</label>
                                                    <p>{{ number_format($a->berat, 0) }} gr</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fotoprofil">Foto Produk</label><br>
                                                    <img width="150px" src="{{ $a->foto_produk }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="dibuat">Dibuat pada</label><br>
                                                    <p>{{ $a->created_at }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <div class="modal fade" id="modal-add-to-cart{{$a->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Masukkan Produk ke Keranjang</h4>
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
                                                            <option value="{{ $p->id }}" {{ $a->id == $p->id ? 'selected':'' }}>{{ $p->nama_produk }}</option>
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
                                <div class="modal fade" id="modal-delete{{$a->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modal-judul">Hapus produk {{ $a->nama_produk }}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda yakin menghapus produk tersebut dari daftar produk?</p>
                                            </div>
                                            <form action="{{ route('produk.destroy', $a->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
                @if (auth()->user()->level == 'admin')
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-register">
                    <i class="fas fa-plus"></i>&nbsp;Tambahkan Data Produk Baru</a>
                </button>
                @endif
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@if (auth()->user()->level == 'admin')
<div class="modal fade" id="modal-register">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Masukkan Data Produk Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Masukkan nama produk">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi produk"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga" id="harga" placeholder="Masukkan harga produk">
                    </div>
                    <div class="form-group">
                        <label for="berat">Berat (gram)</label>
                        <input type="number" class="form-control" name="berat" id="berat" placeholder="Masukkan berat produk">
                    </div>
                    <div class="form-group">
                        <label for="foto_produk">Foto Produk</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto_produk" name="foto_produk">
                                <label class="custom-file-label" for="foto_produk">Upload foto produk</label>
                            </div>
                        </div>
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
@endif
<!-- /.modal -->
@endsection
