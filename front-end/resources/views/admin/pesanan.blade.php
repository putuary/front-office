<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pesanan</title>
  <script src="https://kit.fontawesome.com/387f5a3e4e.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin.css')}}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
  <div class="container">
    <div class="body-content">
      <div class="bg">
        <table class="table table-success table-striped" style="margin-top: 50px;">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Id Pesanan</th>
              <th scope="col">Nomor Meja</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Harga Satuan</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Harga</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php #dd($data);
            foreach ($data as $key => $value) {
            ?>
              <tr>
                <th scope="row">{{ $key+1 }}.</th>
                <td>{{ $value->id_pesanan }}</td>
                <td>{{ $value->no_meja }}</td>
                <td><?php #dd($data);
                    foreach ($value->menu_dipesan as $kunci => $nilai) {
                    ?> {{ $nilai->nama_menu }} </br> <?php } ?></td>
                <td><?php #dd($data);
                    foreach ($value->menu_dipesan as $kunci => $nilai) {
                    ?> {{ rupiah($nilai->harga_jual) }} </br> <?php } ?></td>
                <td><?php #dd($data);
                    foreach ($value->menu_dipesan as $kunci => $nilai) {
                    ?> {{ $nilai->jumlah }} </br> <?php } ?></td>
                <td><?php #dd($data);
                    foreach ($value->menu_dipesan as $kunci => $nilai) {
                    ?> {{ rupiah($nilai->harga_peritem) }} </br> <?php } ?>
                  <hr> {{ rupiah($value->total_harga) }}<br>
                </td>
                <td>{{ $value->status }}</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</html>