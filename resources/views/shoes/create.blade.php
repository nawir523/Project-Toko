<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sepatu Baru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: gainsboro;
            padding: 20px;
        }

        .container {
            margin-top: 50px;
            margin-bottom: 50px;
            width: 60%;
        }

        .form-label {
            font-weight: bold;
            padding:10px
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 5px;
        }

        .btn-secondary {
            border-radius: 5px;
        }

        .alert {
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        h1 {
            margin-bottom: 30px;
            text-align: center;
            color: white;
        }

        .card {
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
      
        
    </style>
</head>
<body>
    <div class="container">
        <div class="w3-card-4 card">
            <div class="w3-container w3-blue">
                <h1>Tambah Sepatu Baru</h1>
            </div>

            <div class="w3-container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin/shoes/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="namamerk" class="form-label">Nama Brand</label>
                        <input type="text" class="form-control" id="namamerk" name="namamerk" value="{{ old('namamerk') }}">
                    </div>
                    <div class="form-group">
                        <label for="tipe" class="form-label">Tipe</label>
                        <input type="text" class="form-control" id="tipe" name="tipe" value="{{ old('tipe') }}">
                    </div>
                    <div class="form-group">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select class="form-control" id="jenis" name="jenis">
                            <option value="anak">Anak</option>
                            <option value="wanita">Wanita</option>
                            <option value="pria">Pria</option>
                            <option value="pria dan wanita">Pria dan Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ukuran" class="form-label">Ukuran</label>
                        <input type="text" class="form-control" id="ukuran" name="ukuran" value="{{ old('ukuran') }}">
                    </div>
                    <div class="form-group">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}">
                    </div>
                    <div class="form-group">
                        <label for="stok" class="form-label">Stok</label>
                        <textarea class="form-control" id="stok" name="stok" rows="5">{{ old('stok') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="" id="gambar" name="gambar">
                    </div>
                    <div class="form-group text-left">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin/shoes') }}" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
