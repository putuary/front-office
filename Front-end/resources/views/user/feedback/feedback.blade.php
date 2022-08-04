<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feedback</title>
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
    <link rel="stylesheet" type="text/css" href={{ URL::asset('style.css')}} />
  </head>
  <body>
    @include('layouts.navbar')
    
    <div class="bg">
        @foreach ($data as $item)
        <div class="card mt-2" style="width: 30rem; margin-left: 100px;">
            <ul class="list-group list-group-flush">
            <li class="list-group-item">Id Pesanan: {{ $item->id_pesanan }}</li>
            <li class="list-group-item">Nama Menu:</li>
            <li class="list-group-item">
                <p> 
                    @foreach ($item->menu_dipesan as $key => $value)
                    {{ $key+1 }}. {{ $value->nama_menu }} </br>
                    @endforeach
                </p>
            </li>
            </ul>
            <a href="/feedback_pesanan/{{ $item->id_pesanan }}" class="btn btn-success btn-sm">Berikan Feedback Anda</a>
        </div>
        </div>
        @endforeach
        
    </div>
  </body>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"
  ></script>
  <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
</html>