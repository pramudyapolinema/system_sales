@extends('layouts.app')
@section('title', 'Profil')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('storage/'. $user->fotoprofil) }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $user->name }}</h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Keranjang</b> <a class="float-right">{{ $keranjang }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Transaksi</b> <a class="float-right">{{ $transaksi }}</a>
                            </li>
                        </ul>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="settings">
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
                                <form class="form-horizontal" action="{{ route('updateProfile') }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Nama" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="password" id="password"
                                                placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-2 col-form-label">No. HP</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                placeholder="08xxxxxxxxxx" value=" {{ $user->phone }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="alamat" name="alamat"
                                                placeholder="Alamat">{{ $user->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                                        <div class="col-sm-10">
                                            <select name="provinsi" id="provinsi" class="form-control">
                                                <option hidden selected>Pilih Provinsi</option>
                                                @foreach ($provinces as $province => $value)
                                                <option value="{{ $province }}"
                                                    {{ $user->provinsi == $province? 'selected':'' }}>{{ $value }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                                        <div class="col-sm-10">
                                            <select name="kota" id="kota" class="form-control">
                                                <option value="{{ $city->city_id }}">
                                                    {{ $city->name .' - '. $city->city_id }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-2 col-form-label">Foto Profil</label>
                                        <div class="col-sm-10">
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
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection
@section('customjs')
<script>
    $(document).ready(function () {
        $('#provinsi').on('change', function () {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/cities/' + provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        $('#kota').empty();
                        $('#kota').append(
                            '<option value="" selected hidden>Pilih Kota</option>');
                        $.each(response, function (key, value) {
                            $('#kota').append('<option value="' + key + '">' +
                                value + ' - ' + key + '</option>');
                        });
                    },
                });
            } else {
                $('#kota').append('<option value="">Pilih Kota</option>');
            }
        });
    });

</script>
@endsection
