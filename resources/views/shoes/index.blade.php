@extends('layouts.app')
 
@section('title', 'Home Product List')
 
@section('contents')

<div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEPATUANANSHOP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-inverse {
            background-color: #111;
            border-color: #333;
            color: white;
        }

        h3{
            margin-left:15px;
        }
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #111;
        }

        li {
        float: left;
        }

        li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        }

        li a:hover {
        background-color: #111;
        }
       
        .card {
            border-radius: 10px;
            margin-top: 20px;
        }
        .card-header {
          
            text-align: center;
        }
        .btn-group .btn {
            margin-right: 5px;
        }
        .img-thumbnail {
            border: none;
            border-radius: 10px;
        }
        .table th, .table td {
           
            text-align: center; 
            font-size: large;
           border: 1px solid;
        }

        .table img {
            max-width: 150px;
            border-radius: 10px;

        }
        .tambah {
            margin-bottom: 20px;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .btn-group-vertical .btn {
            margin-bottom: 5px;
        }
    </style>
</div>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                
                <h3>SEPATUANANSHOP</h3>
            
            </div>
        
          
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="mb-0">Daftar Sepatu</h1>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success mb-4">{{ session('success') }}</div>
                        @endif

                        <div class="row justify-content-between align-items-center mb-4">
                            <div class="col-md-6">
                                <!-- Tombol Tambah Sepatu Baru -->
                                <div class="tambah">
                                    <a href="{{ route('admin/shoes/create') }}" class="btn btn-danger">Tambah Sepatu Baru</a>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <!-- Form Pencarian -->
                                <form action="{{ route('admin/shoes') }}" method="GET" class="form-inline">
                                    <div class="form-group mb-2">
                                        <label for="keyw ord" class="sr-only">Search:</label>
                                        <input type="text" class="form-control" id="keyword" name="keyword" value="{{ $keyword ?? '' }}" placeholder="Cari sepatu...">
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2 ml-2">Cari</button>
                                </form>
                            </div>
                        </div>




                        <div class="table-responsive">
                            <table class="table table-hover">
                               
                                    <tr class="w3-red">
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tipe</th>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Ukuran</th>
                                        <th scope="col">stok</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                
                                <tbody>
                                   @foreach ($shoes as $shoe)
                                    <tr>
                                        <td>
                                            @if ($shoe->gambar)
                                            <a href="{{ asset('storage/' . $shoe->gambar) }}" class="btn btn-info btn-sm">Lihat Gambar</a>
        
                                            @else
                                                Tidak ada gambar
                                            @endif
                                        </td>
                                            
                                            <td>{{ $shoe->namamerk }}</td>
                                            <td>{{ $shoe->tipe}}</td>
                                            <td>{{ $shoe->jenis }}</td>
                                            <td>{{ $shoe->ukuran }}</td>
                                            <td>{{ $shoe->stok }}</td>
                                            <td>Rp {{ number_format($shoe->harga, 0, ',', '.') }}</td>
                                            
                                            <td>
                                           
                                                    <a href="{{ route('admin/shoes/show', $shoe->id) }}" class="btn btn-info btn-sm">Detail</a>
                                                    <a href="{{ route('admin/shoes/edit', $shoe->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('admin/shoes/destroy', $shoe->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

