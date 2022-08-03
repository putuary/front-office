@extends('layouts.katalog')

@section('content')

        <?php #dd($data);
    foreach ($data as $array) { ?>
        <div class="col-md-3" style="margin-bottom: 20px">
            <div class="card">
                <a href="/detail/{{ $array->id_menu }}"><img
                        src='http://{{ env('IP') }}/laravel9-api/public/storage/menu/<?=$array->gambar; ?>'
                        class="card-img-top" alt=<?=$array->nama_menu; ?> width="230" height="130"></a>
                <div class="card-body">
                    <h5 class="card-title"><?=$array->nama_menu; ?></h5>
                    <p class="card-text">{{ rupiah($array->harga_jual) }}</p>
                </div>
            </div>
        </div>
        <?php } ?>
@endsection