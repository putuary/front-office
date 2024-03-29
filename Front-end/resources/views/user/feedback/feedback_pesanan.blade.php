<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <script src="https://kit.fontawesome.com/387f5a3e4e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('style.css')}}">
</head>

<body>
    @include('layouts.navbar')

    <div class="body-content">
        <div class="container">
            <div class="box">
                <div class="bg">
                    <form action="/feedback" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id_pesanan" hidden value="{{ $data->id_pesanan }}">
                        <input type="number" name="no_meja" hidden value="{{ $data->no_meja }}">
                        <div class=" tombol mb-4">
                            <label for="isi_feedback" class="form-label">Berikan Penilaian Anda : </label> <br>
                            <textarea name="isi_feedback" id="isi_feedback" cols="100" rows="10"></textarea>
                            <div class="tomb"><button class="btn btn-success" style="float: end;">Submit</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>

</html>