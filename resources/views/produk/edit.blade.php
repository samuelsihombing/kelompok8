<meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <div class="container">
        <h2>Mengedit Data Produk</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error}} </li>
                    @endforeach
                </ul>
            </div>
            
        @endif
        @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}} </p>
        </div>
            <br/>
        @endif


        <form action="{{action('ProdukController@update', $id)}} " method="post" enctype="multipart/form-data">
        
        {{ csrf_field() }}

        <input type="hidden" name="_method" value="PATCH">

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-form-group col-md-4">
                <label for="nama_produk">Nama Produk :</label>
                <input type="text" name="name" class="form-control" value="{{$produk->name}} ">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="harga">Harga :</label>
                <input type="text" name="harga" class="form-control" value="{{$produk->harga}} ">
            
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="deskripsi">Deskripsi : </label>
                <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control">
                    {{$produk->deskripsi}}
                </textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="image">Gambar </label>
                <br>
                <img src="{{asset('images/'.$produk->image )}} " alt="" style="width: 100px">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="image">Ganti Gambar </label>
                <br>
                <input type="file" name="image"  class="form-control">
                <label > *) Gambar tidak di ganti, kosongkan saja. </label>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    Update
                </button>
                <a href="/Produk" class="btn btn-warning">Kembali</a>
            </div>
            
        </div>
        </form>
    </div>