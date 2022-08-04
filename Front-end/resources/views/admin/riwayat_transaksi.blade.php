<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat</title>
  <script src="https://kit.fontawesome.com/387f5a3e4e.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin.css')}}" />
  <style>
    .box {
      height: 100px;
      background-color: #d9d9d9;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  @include('layouts.navbar_admin')
  <div class="bg">
    <div class="body-content mb-1">
      <div class="container">
        @foreach ($data as $item)
        <div class="row mx-auto">
          <div class="col-5 mt-3">
            <div class="card border-0">
              <div class="card-body" style="text-align: left;">
                <p class="fw-bolder">Id Pesanan: {{ $item->id_pesanan }} </br> Nomor Meja: {{ $item->no_meja }} </p>
                Nama Pesanan: </br>
                <div class="text" style="padding-left: 40px">
                  @foreach ($item->menu_dipesan as $key => $value)
                  {{ $key+1 }} {{ $value->nama_menu }} <br>
                  @endforeach
                </div>
                </br>
                <p class="fw-bolder">Total: {{ rupiah($item->total_harga) }}</br> Waktu: {{ date("H:i:s", strtotime($item->waktu_pesan)) }} WIB </p>
              </div>
            </div>
          </div>
          <div class="col-3" style="margin-top: 100px;">
            <div class="card border-0">
              <div class="card-body" style="background-color: #2DB22A; color: azure;">
                {{ $item->status_transaksi }}
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>