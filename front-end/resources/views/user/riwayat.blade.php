<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat</title>
  <script src="https://kit.fontawesome.com/387f5a3e4e.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
  @include('layouts.navbar')
  <br>
  <?php #dd($data); 
  foreach ($data as $value) {

  ?>
    <div class="container">
      <div class="body-content">
        <div class="box">
          <div class="row mx-auto">
            <div class="col-4">
              <div class="card border-0" style="width: 150%;">
                <div class="card-body" style="text-align: left;">
                  <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <td class="fw-bolder">
                          Id Pesanan : {{ $value->id_pesanan }}
                        </td>
                      </tr>
                      @foreach ($value->menu_dipesan as $item)
                      <tr>
                        <th scope="row" style="width: 60%"><img src="http://{{ env('IP') }}/laravel9-api/public/storage/menu/{{ $item->gambar }}" class="card-img-top" alt="{{ $item->nama_menu }}" style="width:260px ; height: 150px;" /></th>
                        <td style="width: 60%"> {{ $item->nama_menu }} <br> {{ $item->jumlah }} x {{ rupiah($item->harga_jual) }} <br> {{ rupiah($item->harga_peritem) }} </td>
                        <td></td>
                        <td></td>
                      </tr>
                      @endforeach
                      <tr>
                        <td class="fw-bolder">Total Harga : {{ rupiah($value->total_harga) }}</td>
                      </tr>
                      <tr>
                        <td class="fw-bolder">Status Pesanan : {{ $value->status }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
  <?php } ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
</body>

</html>