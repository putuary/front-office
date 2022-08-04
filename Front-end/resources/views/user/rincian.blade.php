<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bill Pembayaran</title>
  <script src="https://kit.fontawesome.com/387f5a3e4e.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('style.css')}}" />
</head>

<body>
  @include('layouts.navbar')

  <div class="container">
    <div class="row mt-5">
      <div class="col-12 col-sm-6 col-md-4">
        <div class="card" style="width: 200%">
          <div class="card-header">Total Pembayaran Anda</div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Menu</th>
                  <th scope="col">Harga Satuan</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Harga</th>
                </tr>
              </thead>
              <tbody>
                <?php #dd($data);
                $i = 1;
                foreach ($data->menu_dipesan as $value) { ?>
                  <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $value->nama_menu }}</td>
                    <td>{{ rupiah($value->harga_jual) }}</td>
                    <td>{{ $value->jumlah }}</td>
                    <td>{{ rupiah($value->harga_peritem) }}</td>
                  </tr>
                <?php $i++;
                } ?>
                <tr>
                  <th scope="row"></th>
                  <th scope="row"></th>
                  <th scope="row"></th>
                  <td colspan="row">Total</td>
                  <td>{{ rupiah($data->total_harga) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-12">
        <a href="/"><button class="btn btn-success float-end px-5">Kembali ke Katalog</button></a>
      </div>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>

</html>