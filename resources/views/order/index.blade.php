@extends('layouts.app')
@section('title', 'Pelanggan')
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
                        <h3 class="card-title">Data Seluruh Pelanggan</h3>
                      </div>
                    <div class="card-body">
                        <table class="table table-bordered table-stripped" id="example1" aria-label="">
                            <thead>
                                <tr>
                                    <th scope="">No.</th>
                                    <th scope="">Nama</th>
                                    <th scope="">Email</th>
                                    <th scope="">No. HP</th>
                                    <th scope="">Foto</th>
                                    <th scope="">Dibuat</th>
                                    <th scope="">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pelanggan)
                                @foreach ($pelanggan as $a)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $a->name }}</td>
                                    <td>{{ $a->email }}</td>
                                    <td>{{ $a->phone }}</td>
                                    <td><img width="100px" src="{{ asset('storage/'.$a->fotoprofil) }}" alt="fotoprofil"></td>
                                    <td>{{ $a->created_at }}</td>
                                    <td>
                                        <a data-toggle="modal" id="infoPelanggan" data-target="#modal-info{{$a->id}}"
                                            class="btn btn-info"><em class="fas fa-info-circle"></em></a>
                                        <a data-toggle="modal" id="updatePelanggan" data-target="#modal-edit{{$a->id}}"
                                            class="btn btn-success"><em class="fas fa-edit"></em></a>
                                        <form action="{{ route('pelanggan.destroy', $a->id) }}" method="POST">
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
                                                <form action="{{ route ('pelanggan.update', $a->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="nama">Nama</label>
                                                        <input type="text" class="form-control" name="name" id="name"
                                                            value="{{ $a->name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" name="email" id="email"
                                                            value="{{ $a->email }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" name="password"
                                                            id="password" placeholder="Masukkan password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="level">Level</label>
                                                        <select class="form-control" name="level" id="name">
                                                            <option {{ $a->level == 'admin' ? 'selected':'' }}
                                                                value="admin">Admin</option>
                                                            <option {{ $a->level == 'pelanggan' ? 'selected':'' }}
                                                                value="pelanggan">Pelanggan</option>
                                                            <option {{ $a->level == 'kasir' ? 'selected':'' }}
                                                                value="kasir">Kasir</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fotoprofil">Foto Profil</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="fotoprofil" name="fotoprofil">
                                                                <label class="custom-file-label" for="fotoprofil">Upload
                                                                    foto profil</label>
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
                                                <h4 class="modal-title" id="modal-judul">Detail {{ $a->name }}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <p>{{ $a->name }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <p>{{ $a->email }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="level">Level</label>
                                                    <p>{{ $a->level }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fotoprofil">Foto Profil</label><br>
                                                    <img width="150px" src="{{ asset('storage/'.$a->fotoprofil) }}">
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
                    <em class="fas fa-plus"></em>&nbsp;Tambahkan Data Pelanggan Baru</a>
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
                <h4 class="modal-title">Masukkan Data Pelanggan Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pelanggan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Masukkan password">
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control" name="level" id="name">
                            <option selected value="pelanggan">Pelanggan</option>
                            <option value="teknisi">Teknisi</option>
                            <option value="kasir">Kasir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fotoprofil">Foto Profil</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="fotoprofil" name="fotoprofil">
                                <label class="custom-file-label" for="fotoprofil">Upload foto profil</label>
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
<!-- /.modal -->
@endsection
