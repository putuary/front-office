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
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    @include('layouts.navbar')

    <table class="table table-borderless">
      <form action="{{ route('pesanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="number" class="form-control" id="no_meja" value='2' name="no_meja" style='display:none'>
        <tbody>
          <?php $i=0; #dd($data);
          foreach ($data as $array) { ?>
          <div id="item">
            <input type="number" class="form-control"  value={{ $array->id_menu }} name="id_menu[{{ $i }}]" style='display:none'>
            <tr>
              <th scope="row" style="width: 15%"><img src="http://{{ env('IP') }}/laravel9-api/public/storage/menu/{{ $array->gambar }}" class="card-img-top" alt={{ $array->nama_menu }} style="width:260px ; height: 150px;"/></th>
              <td style="width: 15%">{{ $array->nama_menu }} <br> {{ rupiah($array->harga_jual) }}</td>
              <td style="width: 1%"><input type="number" min="1" max={{ $array->stok }} value=1 name="jumlah[{{ $i }}]"></td>
              <td><button type="button" onclick="hapus({{ $array->id_menu }})">hapus</button></td>
            </tr>
          </div>
          <?php $i++; } ?>
        </tbody>
        @if (count($data)>0)
          <tr>
            <td>
              <button type="submit" class="btn btn-success px-4">Pesan</button>
            </td>
          </tr>
        @endif
      </form>
    </table>
    <div class="tmb">
    </div>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"
  ></script>

  <script>
  async function deleteData(url = '', data = {}) {
    // Default options are marked with *
    const response = await fetch(url, {
      method: 'DELETE', // *GET, POST, PUT, DELETE, etc.
      mode: 'cors', // no-cors, *cors, same-origin
      cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
      credentials: 'same-origin', // include, *same-origin, omit
      headers: {
        'Content-Type': 'application/json'
        // 'Content-Type': 'application/x-www-form-urlencoded',
      },
      redirect: 'follow', // manual, *follow, error
      referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
      body: JSON.stringify(data) // body data type must match "Content-Type" header
    });
    
    
  }
function hapus(id_menu) {
  let url=`{{ env('URL') }}`;
  let ip=`{{ env('IP') }}`;
  let no_meja=document.getElementById("no_meja").value;
  deleteData(`${url}/api/keranjang`, { no_meja: no_meja, id_menu: id_menu })
  .then((data) => {
    // console.log(data); // JSON data parsed by `data.json()` call
  });

    fetch(`${url}/api/keranjang/${no_meja}`)
    .then((response) => response.json())
    .then((data) => {
    let isi = data.data;
          console.log(isi);
          let text = '';
          isi.forEach(([key, value]) => {
            text += `
            <input type="number" class="form-control"  value=${value.id_menu} name="id_menu[${key}]" style='display:none'>
            <tr>
              <th scope="row" style="width: 15%"><img src="http://${ip}/laravel9-api/public/storage/menu/${value.gambar}" class="card-img-top" alt=${value.nama_menu} style="width:260px ; height: 150px;"/></th>
              <td style="width: 15%">${value.nama_menu} <br>  ${value.harga_jual}</td>
              <td style="width: 1%"><input type="number" min="1" max=${value.stok} value=1 name="jumlah[${key}]"></td>
              <td><button type="button" onclick="hapus(${value.id_menu})">hapus</button></td>
            </tr>`;
          });
          
          document.getElementById("item").innerHTML = text;
        });
}
  </script>

  </body>
</html>
