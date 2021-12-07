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
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $transaksi }}</h3>
                        <p>Pesanan Menunggu Pembayaran</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill"></i>
                    </div>
                    <a href="{{ route('transaksi.index') }}" class="small-box-footer">Halaman Transaksi <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $dibayar }}</h3>
                        <p>Pesanan Dibayar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <a href="{{ route('transaksi.index') }}" class="small-box-footer">Halaman Transaksi <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $dikirim }}</h3>
                        <p>Pesanan Dikirim</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <a href="{{ route('transaksi.index') }}" class="small-box-footer">Halaman Transaksi <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endif
    </div>
    <div class="row">
        <section class="col-lg-7 connectedSortable">


        </section>
    </div>
    </div>
</section>
</div>
@endsection
