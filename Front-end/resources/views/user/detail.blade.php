<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Detail <?= $data->nama_menu; ?></title>
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
        <section id="kartu">
          <div class="bg container">
            <div class="col-md-6">
              <div class="card float-center">
                <div class="card-body">
                  <!-- <h5 class="card-title">Card title</h5> -->
                  <img src="http://{{ env('IP') }}/laravel9-api/public/storage/menu/<?= $data->gambar; ?>" class="card-img-top" alt=<?= $data->nama_menu; ?> />
                  <h6 class="card-subtitle mb-2 text-muted"><?= $data->nama_menu; ?></h6>
                  <h6 class="card-subtitle mb-2 text-muted">{{ rupiah($data->harga_jual) }}</h6>
                  <p class="card-text">
                    <?= $data->deskripsi; ?>
                  </p>
                  <div class="col-12">
                    <form action="{{ route('keranjang.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="number" class="form-control" id="exampleInputText" aria-describedby="TextHelp" value='2' name="no_meja" style='display:none'>
                      <input type="number" class="form-control" id="exampleInputText" aria-describedby="TextHelp" value={{ $data->id_menu }} name="id_menu" style='display:none'>
                      <button class="btn btn-success float-first px-7">
                        Masukkan Keranjang
                      </button>
                    </form>
                    <a href="memesan.html"
                      ><button class="btn btn-success float-end px-4">
                        Pesan
                      </button></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
