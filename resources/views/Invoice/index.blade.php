<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Invoice</title>
  </head>
  <body>
    <!-- Baris Pertama -->
      <div class="row justify-content-center isi1">
        <div class="col-md-6">
          <img src="/images/logo.png">
        </div>

        <div class="col-md-3">
          <div class="row">
            <div class="col-md-12"><h1>INVOICE</h1></div>
            <div class="col-md-12"><hr></div>
            <div class="col-md-12"><p class="label1 mb-0">Invoice#</p></div>
            <div class="col-md-12"><p class="label3">AA/BB/001/27-Nov/2021</p></div>
          </div>

          <div class="row">
            <div class="col-md-6"><p class="label2 mb-0">Date : </p></div>
            <div class="col-md-6"><p class="mb-0 label3">Nov 27, 2021</p></div>
          </div>

          <div class="row">
            <div class="col-md-6"><p class="label2 mb-0">Due Date : </p></div>
            <div class="col-md-6"><p class="label3">Nov 28, 2021</p></div>
          </div>

           <div class="row">
            <div class="col-md-12"><p class="label1  mb-0">Shipping</p></div>
          </div>

          <div class="row mb-0">
            <div class="col-md-6"><p class="label2  mb-0">Ship Date : </p></div>
            <div class="col-md-6"><p class="mb-0 label3">Nov 27, 2021</p></div>
          </div>

          <div class="row mb-0">
            <div class="col-md-6"><p class="label2  mb-0">Ship Via : </p></div>
            <div class="col-md-6"><p class="mb-0 label3">JNE</p></div>
          </div>

        </div>
      </div>
    <!-- End Baris Pertama -->

    <!-- Baris Kedua -->
      <div class="row justify-content-center">
        <div class="col-md-5">
          <p class="mb-0 label4">From to: </p>
          <p class="mb-0 label5">BILLIE BEANS</p>
          <p >Alamat </p>
          <p>+62</p>
        </div>

        <div class="col-md-2">
          <p class="mb-0 label4">Ship to: </p>
          <p class="mb-0 label5">{{$user->name}} </p>
          <p>{{$user->alamat}}</p>
          <p>{{$user->phone}}</p>
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
          @foreach($transaksi as $t)
            <tr>
              
              <div class="form-group">
                <td id="">{{$t->produk->nama_produk}}</td>
              </div>
              <div class="form-group">
                <td id="">{{$t->produk->berat}}</td>
              </div>
              <div class="form-group">
                <td id="">Rp {{$t->produk->harga}}</td>
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
              <td>{{$usertransaction->ongkir}}</td>
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
          <p  class="mb-0 label4">PAYMENT INSTRUCTION</p>
          <ul class="label2 mb-0">
            <li>Cash</li>
            <li>Bank Transfer / BCA</li>
          </ul>
          <p class="tab mb-0">a.n Name</p><br>
          <p class="tab">00000</p>
        </div>

        <div class="col-md-2">
          <div class="row">
            <div class="col-md-6"><p class="label2 mb-0">Subtotal : </p></div>
            <div class="col-md-6"><p class="mb-0 p3">{{$usertransaction->berat}}</p></div>
          </div>

          <div class="row">
            <div class="col-md-6"><p class="label2 mb-0">Total : </p></div>
            <div class="col-md-6"><p class="p3">{{$usertransaction->total_bayar}}</p></div>
          </div>

      </div>
    <!-- End Baris Keempat -->


       




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    
  </body>
</html>