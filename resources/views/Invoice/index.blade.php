<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <title>Invoice</title>
</head>

<body>
    <!-- Baris Pertama -->
    <div class="row justify-content-center isi1">
        <div class="col-md-6">
            <img src="{{ asset('images/logo.png') }}">
        </div>

        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <h1>INVOICE</h1>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
                <div class="col-md-12">
                    <p class="label1 mb-0">Invoice#{{ $transaksi->id_transaksi }}</p>
                </div>
                <div class="col-md-12">
                    <p class="label3">AA/BB/001/{{ date( 'd-M', strtotime($transaksi->created_at)) }}/{{ date( 'Y', strtotime($transaksi->created_at)) }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <p class="label2 mb-0">Date : </p>
                </div>
                <div class="col-md-6">
                    <p class="mb-0 label3">{{ date('M d, Y', strtotime($transaksi->created_at)) }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <p class="label2 mb-0">Due Date : </p>
                </div>
                <div class="col-md-6">
                    <p class="label3">{{ date('M d, Y', strtotime($transaksi->created_at . '+1 day')) }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p class="label1  mb-0">Shipping</p>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6">
                    <p class="label2  mb-0">Ship Date : </p>
                </div>
                <div class="col-md-6">
                    <p class="mb-0 label3">{{ date('M d, Y', strtotime($transaksi->updated_at)) }}</p>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6">
                    <p class="label2  mb-0">Ship Via : </p>
                </div>
                <div class="col-md-6">
                    <p class="mb-0 label3">JNE</p>
                </div>
            </div>

        </div>
    </div>
    <!-- End Baris Pertama -->

    <!-- Baris Kedua -->
    <div class="row justify-content-center">
        <div class="col-md-5">
            <p class="mb-0 label4">From : </p>
            <p class="mb-0 label5">BILLIE BEANS COFFEE SUPPLY.CO</p>
            <p>Jalan Puyengan No.25A<br>KOTA PROBOLINGGO<br>JAWA TIMUR</p>
            <p>+6281233355174</p>
        </div>

        <div class="col-md-2">
            <p class="mb-0 label4">Ship to: </p>
            <p class="mb-0 label5">{{ Auth::user()->name }} </p>
            <p>{{ Auth::user()->alamat }}<br>{{ Auth::user()->city->name }}<br>{{ Auth::user()->province->name }}</p>
            <p>{{ Auth::user()->phone }}</p>
        </div>
    </div>


    <!-- End Baris Kedua -->

    <!-- Tabel -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <form action="" method="POST">
                    <table class="table">

                        <thead>
                            <tr class="label4">
                                <th scope="col">DESCRIPTION</th>
                                <th scope="col">QTY</th>
                                <th scope="col">RATE</th>
                                <th scope="col">AMOUNT</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($produktransaksi as $t)
                            <tr>

                                <div class="form-group">
                                    <td id="">{{ $t->produk->nama_produk}}</td>
                                </div>
                                <div class="form-group">
                                    <td id="">{{$t->produk->berat}} gr</td>
                                </div>
                                <div class="form-group">
                                    <td id="">Rp{{ number_format($t->produk->harga, 0)}}</td>
                                </div>
                                <div class="form-group">
                                    <td id="">{{$t->jumlah}}</td>
                                </div>

                            </tr>
                            @endforeach
                            <tr>
                                <td class="label2">*Ongkos Kirim</td>
                                <td></td>
                                <td></td>
                                <td>Rp{{ number_format($transaksi->ongkir, 0) }}</td>
                            </tr>
                        </tbody>

                    </table>
                </form>
            </div>
        </div>

    </div>

    <!-- End Tabel -->

    <!-- Baris Keempat -->
    <div class="row justify-content-center isi1">
        <div class="col-md-5">
            <p class="mb-0 label4">PAYMENT INSTRUCTION</p>
            {{-- <ul class="label2 mb-0">
                <li>Cash</li>
                <li>Bank Transfer / BCA</li>
            </ul> --}}
            <p class="tab mb-0">Silahkan untuk langsung menghubungi admin<br> <strong>Phone: (+62)
                81233355174</strong></p><br>
            {{-- <p class="tab">00000</p> --}}
        </div>

        <div class="col-md-2">
            <div class="row">
                <div class="col-md-6">
                    <p class="label2 mb-0">Subtotal : </p>
                </div>
                <div class="col-md-6">
                    <p class="mb-0 p3">Rp{{ number_format($subtotal, 0) }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <p class="label2 mb-0">Total : </p>
                </div>
                <div class="col-md-6">
                    <p class="p3">Rp{{ number_format($transaksi->total_bayar, 0) }}</p>
                </div>
            </div>

        </div>
        <!-- End Baris Keempat -->

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
            integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
        </script>

</body>

</html>
