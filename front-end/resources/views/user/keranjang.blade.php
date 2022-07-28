<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Keranjang</title>
  <script src="https://kit.fontawesome.com/387f5a3e4e.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('style.css')}}" />
</head>

<body>
  @include('layouts.navbar')

  <table class="table table-borderless">
    <form action="{{ route('pesanan.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="number" class="form-control" value='2' name="no_meja" style='display:none'>
      <tbody>
        <?php $i = 0; #dd($data);
        foreach ($data as $array) { ?>
          <input type="number" class="form-control" value={{ $array->id_menu }} name="id_menu[{{ $i }}]" style='display:none'>
          <tr>
            <th scope="row" style="width: 15%"><img src="http://{{ env('IP') }}/laravel9-api/public/storage/menu/{{ $array->gambar }}" class="card-img-top" alt="nasgor" style="width:260px ; height: 150px;" /></th>
            <td class="fw-bolder" style="width: 15%">{{ $array->nama_menu }} <br> {{ rupiah($array->harga_jual) }}</td>
            <td style="width: 1%"><input type="number" min="1" max={{ $array->stok }} value=1 name="jumlah[{{ $i }}]"></td>
            <td><button type="button" class="btn btn-danger">Hapus</button></td>
          </tr>
        <?php $i++;
        } ?>
      </tbody>
      <tr>
        <td>
          <button class="btn btn-success px-4">Pesan</button>
        </td>
      </tr>
    </form>
  </table>
  <div class="tmb">
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>

</html>