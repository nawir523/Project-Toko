<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sepatu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        h1 {
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }

        .card {
            padding: 20px;
            background-color: Dodgerblue;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
        }
        p {
            color:white;
            text-align: center;
        }

        h4 {
            color:white;
            text-align: center;
        }
        
        .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 10px; /* Adjust the gap between buttons */
        }

        .btn-group .btn {
            flex: 1; /* Distribute space evenly among buttons */
            padding: 10px; /* Adjust padding as needed */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Sepatu</h1>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card mx-auto">
                    @if ($shoe->gambar)
                        <img src="{{ asset('storage/' . $shoe->gambar) }}" alt="{{ $shoe->namamerk }}">
                    @else
                        <p class="text-center">No image available</p>
                    @endif
                    <div class="card-body ">
                        <h4 class="card-text"><strong></strong> {{ $shoe->namamerk }}</h4>
                        <p class="card-text"><strong></strong> {{ $shoe->tipe }}</p>
                        <p class="card-text"><strong>Jenis:</strong> {{ $shoe->jenis }}</p>
                        <p class="card-text"><strong>Ukuran:</strong> {{ $shoe->ukuran }}</p>
                        <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($shoe->harga, 0, ',', '.') }}</p>
                        <p class="card-text"><strong>Stok:</strong> {{ $shoe->stok }}</p>
                    </div>
                    <div class="btn-group mt-3">
                        <a href="{{ route('admin/shoes/edit', $shoe->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin/shoes/destroy', $shoe->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                        </form>
                        <a href="{{ route('admin/shoes') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
