<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Keranjang</title>
    <script
      src="https://kit.fontawesome.com/387f5a3e4e.js"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('style.css')}}" />
  </head>
  <body>
    @include('layouts.navbar')
      <form action="{{ route('pesanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="number" class="form-control" id="no_meja" value='2' name="no_meja" style='display:none'>
        <table class="table table-borderless">
          <tbody id="item">
            <?php $i=0; #dd($data);
            foreach ($data as $array) { ?>
              <tr>
                <th scope="row" style="width: 15%"><img src="http://{{ env('IP') }}/laravel9-api/public/storage/menu/{{ $array->gambar }}" class="card-img-top" alt={{ $array->nama_menu }} style="width:260px ; height: 150px;"/></th>
                <td><input type="number" class="form-control"  value={{$array->id_menu}} name="id_menu[{{ $i }}]" style='display:none'></td>
                <td style="width: 15%">{{ $array->nama_menu }} <br> {{ rupiah($array->harga_jual) }}</td>
                <td style="width: 1%"><input type="number" min="1" max={{ $array->stok }} value=1 name="jumlah[{{ $i }}]"></td>
                <td><button type="button" onclick="hapus({{ $array->id_menu }})">hapus</button></td>
              </tr>
          
            <?php $i++; } ?>
          </tbody>
        </table>
        @if (count($data)>0)
          <tr>
            <td>
              <button type="submit" class="btn btn-success px-4">Pesan</button>
            </td>
          </tr>
        @endif
      </form>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"
  ></script>

  <script>
    function hapus(id_menu) {
      let url=`{{ env('URL') }}`;
      let ip=`{{ env('IP') }}`;
      let no_meja=document.getElementById("no_meja").value;

      var xhr = new XMLHttpRequest();
      xhr.open("DELETE", `${url}/api/keranjang`, true);
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.send(JSON.stringify({
        no_meja: no_meja, 
        id_menu: id_menu
      }));
      xhr.onload = function() {
          var data = JSON.parse(this.responseText);
          console.log(data);
      };
      window.location.reload();
    }

  </script>

  </body>
</html>
