<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Transaksi</title>
  <script src="https://kit.fontawesome.com/387f5a3e4e.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin.css')}}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <style>
    .box {
      height: 50px;
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
    <div class="container">
      <p class="text-uppercase" style="margin-top: 50px">KLIK NOMOR MEJA</p>
      <div class="row">
        @foreach ($data as $no_meja)
        <div class="col-1">
          <a href="/admin/transaksi/{{ $no_meja }}">
            <div class="box">{{ $no_meja }}</div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>