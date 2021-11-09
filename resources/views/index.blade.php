@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if (auth()->user()->level == 'pelanggan')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">

                        <h3>{{ $keranjang }}</h3>
                        <p>Keranjang</p>

                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('keranjang.index') }}" class="small-box-footer">Halaman Keranjang <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endif
            {{-- <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div> --}}
            {{-- <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $user }}</h3>

            <p>Jumlah Pengguna</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="{{ route('alluser.index') }}" class="small-box-footer">Halaman Pengguna <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div> --}}
    {{-- <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div> --}}
    </div>
    <div class="row">
        <section class="col-lg-7 connectedSortable">


        </section>
    </div>
    </div>
</section>
</div>
@endsection
