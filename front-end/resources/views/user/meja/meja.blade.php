<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Transaksi</title>
  <script src="https://kit.fontawesome.com/387f5a3e4e.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('login.css')}}" />
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
  <div class="bg">
    <div class="container">
      <p class="text-uppercase" style="margin-top: 50px">KLIK NOMOR MEJA</p>
      <div class="row">
        <?php foreach ($data as $array) { ?>
          <div class="col-1">
            <div class="box"><button class="btn btn-link" onclick="setmeja({{ $array->no_meja }})">{{ $array->no_meja }}</button></div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    function setmeja(no_meja) {
      window.localStorage.setItem('no_meja', no_meja);
      window.location.href = `{{ env('APP_URL') }}`;
    }
  </script>
</body>

</html>