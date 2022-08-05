<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Transaksi</title>
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
      margin-left: 5px;
    }
  </style>
</head>

<body>
  @include('layouts.navbar_admin')
  <?php #dd($data); 
  ?>
  <!-- <div class="bg">
    <div class="row">
      <div class="col-3">
        <div class="box">{{ count($data) }} Transaksi ditemukan</div>
      </div>
    </div>
  </div> -->
  <!-- @if (count($data)>1)
  <ul class="pagination pagination-sm">
    @foreach($data as $key => $item)
    <li class="page-item"><button class="page-link" id="button_halanan" onclick="getPesanan({{ $key }})">{{ $key+1 }}</button></li>
    @endforeach
  </ul>
  @endif -->
  <div class="bg" id="konten">
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;
    }

    const formatRupiah = (money) => {
      return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
      }).format(money);
    }

    function kembalian(total_harga) {
      let bayar = document.getElementById('bayar').value;
      document.getElementById("uang_bayar").value = bayar;
      document.getElementById('kembalian').innerHTML = formatRupiah(bayar - total_harga);
    }

    getPesanan(0);

    function getPesanan(item) {
      let data = <?php echo json_encode($data); ?>;
      console.log(data[item]);
      let pesanan = data[item];

      let text = `

        <div id="print">
          <div class="container">
            <div class="bg">
              <table class="table-border">
                <tbody>
                  <tr>
                    <th scope="col">
                      <div class="row">
                        <div class="col-12">
                          <div class="box" style="padding:20px ; background-color:rgb(215, 246, 250); border-radius: 5px;">Id Pesanan: ${pesanan.id_pesanan}</div>
                        </div>
                      </div>
                    </th>
                  </tr>
                </tbody>
              </table>
              <table class="table-border">
                <tbody>
                  <th>  
                    <div class="row">
                      <div class="col-12">
                        <div class="box" style="padding:20px ; background-color:rgb(215, 246, 250); border-radius: 5px;">{{ count($data) }} Transaksi ditemukan</div>
                      </div>
                    </div>
                  </th>
                  <td> 
                    <div class="row">
                      <div class="col-14">
                        <div class="box" style="padding:20px ; background-color:rgb(215, 246, 250); border-radius: 5px;">Transaksi ${item+1}</div>
                      </div>
                    </div>
                  </td>
                </tbody>
              </table>
            </container>

          <container style="margin-top: 30px;">
          <table class="table table-success" style="background-color:#d9d9d9; margin-top: 20px; border-radius: 5px;">
            <thead>
              <tr>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga Satuan</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Harga</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">`;
      pesanan.menu_dipesan.forEach(element => {
        text += `${element.nama_menu} </br>`
      });
      text += `</th>
                <td>`;
      pesanan.menu_dipesan.forEach(element => {
        text += `${formatRupiah(element.harga_jual)} </br>`
      });
      text += `</td>
              <td>`
      pesanan.menu_dipesan.forEach(element => {
        text += `${element.jumlah} </br>`
      });
      text += `</td>
                <td>`;
      pesanan.menu_dipesan.forEach(element => {
        text += `${formatRupiah(element.harga_peritem)} </br>`
      });

      text += `   </td>
              </tr>
            </tbody>
          </table>
          <table class="table table-success" style="background-color:#d9d9d9;">
            <thead>
              <tr>
                <th scope="col">Total</th>
                <th scope="col">Bayar</th>
                <th scope="col">Kembalian</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">${formatRupiah(pesanan.total_harga)}</th>
                
                <td><input type="number" class="form-control" id="bayar" min=${pesanan.total_harga} name="bayar" onkeyup="kembalian(${pesanan.total_harga})"></td>
                <td id="kembalian"></td>
              </tr>
            </tbody>
          </table>
          </container>
        </div>

        @if (count($data)>1)
  <ul class="pagination pagination-sm">
    @foreach($data as $key => $item)
    <li class="page-item"><button class="page-link" id="button_halanan" onclick="getPesanan({{ $key }})">{{ $key+1 }}</button></li>
    @endforeach
  </ul>
  @endif

          <form action="/admin/transaksi" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
              <input type="number" class="form-control" id="id_pesanan" hidden name="id_pesanan" value=${pesanan.id_pesanan}>
              <input type="number" class="form-control" id="uang_bayar" hidden name="uang_bayar">
              <button type="submit" class="btn btn-success">Cetak</button>
            </div>
          </form>`;
      document.getElementById("konten").innerHTML = text;

    }
  </script>
</body>

</html>