<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Transaksi1</title>
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
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin.css')}}" />
    <style>
      .box {
        height: 50px;
        background-color: #d9d9d9;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        margin-left: 60px;
      }
    </style>
  </head>
  <body>
    <div id="print">
      <div class="bg">
        <div class="container">
          <div class="row">
            <div class="col-3">
              <div class="box">Id Pesanan: {{ $data->id_pesanan }}</div>
            </div>
            <container style="margin-top: 30px;">
            <table class="table" style="background-color:#d9d9d9;">
              <thead>
                <tr>
                  <th scope="col">Nama Produk</th>
                  <th scope="col">Harga Per-Item</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Harga</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">
                  @foreach ($data->menu_dipesan as $item)
                      {{ $item->nama_menu }} <br>
                  @endforeach</th>
                  <td>
                    @foreach ($data->menu_dipesan as $item)
                    {{ rupiah($item->harga_jual) }} <br>
                    @endforeach
                  </td>
                  <td>
                    @foreach ($data->menu_dipesan as $item)
                      {{ $item->jumlah }} <br>
                    @endforeach
                  </td>
                  <td>
                    @foreach ($data->menu_dipesan as $item)
                      {{ rupiah($item->harga_peritem) }} <br>
                    @endforeach
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="table" style="background-color:#d9d9d9;">
              <thead>
                <tr>
                  <th scope="col">Total</th>
                  <th scope="col">Bayar</th>
                  <th scope="col">Kembalian</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">{{ rupiah($data->total_harga) }}</th>
                  <td>{{ rupiah($data->uang_bayar) }}</td>
                  <td>{{ rupiah($data->uang_kembalian) }}</td>
                </tr>
              </tbody>
            </table>
          </container>
          </div>
        </div>
      </div>
    </div>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"
  ></script>
  <script>
    printDiv('print');
    function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
 </script>
  </body>
</html>