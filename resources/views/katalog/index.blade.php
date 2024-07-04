@extends('layouts.app')
 
@section('title', 'Home Product List')
 
@section('contents')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Sepatu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   <style>
        /* Style untuk kartu sepatu */
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: box-shadow 0.3s ease;
            text-align: center; 
            background-color: blue;
            color:white;
            margin-top:10px;
        }
        
        .card:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        /* Style untuk judul */
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .card-subtitle {
            font-size: 1.15rem;
            color: white;
            margin-bottom: 0.5rem;
        }

        /* Style untuk tombol */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Custom CSS untuk form pencarian */
        .search-form {
            display: flex;
            justify-content: flex-end;
        }

        .search-form input[type=text] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 5px;
            width: 200px;
        }

        .search-form button {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #0056b3;
        }

        /* Adjust navbar style */
        .w3-top {
            position: sticky;
            top: 10px; /* Changed to 10px for visibility */
            z-index: 1000; /* Ensure it's above other content */
            background-color: #343a40; /* Set navbar background color */
            margin-top:50px
        }

        .w3-bar {
            justify-content: space-between; /* Align items in navbar */
            align-items: center; /* Center items vertically */
            padding: 10px 20px; /* Adjust padding */
        }

        .w3-bar .brand-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .w3-bar .search-form {
            display: flex;
            align-items: center; /* Center search form vertically */
        }

        .w3-bar .search-form input[type=text] {
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 200px;
        }

        .w3-bar .search-form button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 5px;
        }

        .w3-bar .search-form button:hover {
            background-color: #0056b3;
        }
        
        .modal-body {
            text-align: center; 
            background-color: black;
            color: white;
        }
      
        

    </style>
</head>

<body>
    
    <div class="w3-top">
    <div class="w3-bar w3-blue w3-card">
        <div class="w3-bar-item w3-center w3-padding-large">
            <h3 class="m-0">SEPATUANANSHOP</h3>
        </div>
        <div class="w3-bar-item w3-padding-large w3-right">
            <form action="{{ route('katalog.index') }}" method="GET" class="search-form">
                <input type="text" id="keyword" name="keyword" value="{{ $keyword ?? '' }}" placeholder="Cari sepatu...">
                <button type="submit" class="w3-button w3-blue">Cari</button>
            </form>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        @foreach($shoes as $shoe)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card w3-card-5">
                <img src="{{ asset('storage/' . $shoe->gambar) }}" class="card-img-top" alt="Sepatu {{ $shoe->namamerk }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $shoe->namamerk }}</h5>
                    <h5 class="card-subtitle mb-2 w3-text-pink">{{ $shoe->tipe }}</h5>
                    <p class="card-text">Harga: Rp {{ number_format($shoe->harga, 0, ',', '.') }}</p>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailModal{{ $shoe->id }}">
                        Lihat Sepatu
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="detailModal{{ $shoe->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $shoe->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="detailModalLabel{{ $shoe->id }}">Detail Sepatu {{ $shoe->namamerk }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $shoe->gambar) }}" class="card-img-top mb-3" alt="Sepatu {{ $shoe->namamerk }}">
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title">{{ $shoe->namamerk }} {{ $shoe->tipe }}</h5>
                            <p class="card-text"><strong>Ukuran Tersedia:</strong> {{ $shoe->ukuran }}</p>
                            <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($shoe->harga, 0, ',', '.') }}</p>
                            <form id="form-{{ $shoe->id }}">
                                <div class="form-group">
                                    <label for="jumlah-{{ $shoe->id }}">Jumlah beli sepatu:</label>
                                    <input type="number" id="jumlah-{{ $shoe->id }}" name="jumlah" min="1" class="form-control" onchange="updateTotalPrice({{ $shoe->harga }}, {{ $shoe->id }})">
                                </div>
                                <p id="total-{{ $shoe->id }}" class="mb-3"><strong>Total Harga:</strong> Rp {{ number_format($shoe->harga, 0, ',', '.') }}</p>
                                <button type="button" class="btn btn-primary btn-block" onclick="beliSepatu({{ $shoe->id }})">Beli</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        @endforeach
    </div>
</div><script>
    function updateTotalPrice(harga, shoeId) {
        let jumlah = document.getElementById(`jumlah-${shoeId}`).value;
        let total = harga * jumlah;
        document.getElementById(`total-${shoeId}`).innerText = `Total Harga: Rp ${total.toLocaleString('id-ID')}`;
    }

    function beliSepatu(shoeId) {
        let jumlah = document.getElementById(`jumlah-${shoeId}`).value;
        let url = "{{ route('transaksi.store') }}"; // Sesuaikan dengan route untuk menyimpan transaksi
        let data = {
            shoe_id: shoeId,
            jumlah: jumlah,
            _token: '{{ csrf_token() }}'
        };

        // Kirim data menggunakan fetch API atau Axios
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            // Lakukan penanganan jika perlu, seperti menampilkan pesan sukses atau memperbarui UI
        })
        .catch((error) => {
            console.error('Error:', error);
            // Lakukan penanganan error jika perlu
        });
    }
</script>

 @endsection
<!-- Script dan Stylesheet -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>
