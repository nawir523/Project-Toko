@extends('layouts.app')
 
@section('title', 'Home Product List')
 
@section('contents')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Sepatu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        h1, h2 {
            text-align: center;
            margin-top: 20px;
        }

        .table-container {
            margin: 20px auto;
            max-width: 90%;
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
        }

        .table {
            margin: 0;
        }

        thead th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }

        tbody td {
            text-align: center;
        }

        tfoot td {
            background-color: #f1f1f1;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .highlight-row:hover {
            background-color: #f2f2f2;
        }

        .highlight-total {
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center !important;
        }

        .btn-delete {
            background-color: transparent;
            border: none;
            color: red;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .btn-excel {
            background-color: green;
            color: white;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Transaksi Sepatu</h1>
    <h2>Daftar Transaksi</h2>

    <div class="table-container w3-card">
         <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal Transaksi</th>
                    <th>Nama Sepatu</th>
                    <th>Tipe</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grandTotal = 0;
                @endphp
                @foreach ($transaksis as $transaction)
                    @php
                        $totalHarga = $transaction->jumlah * $transaction->shoe->harga;
                        $grandTotal += $totalHarga;
                    @endphp
                    <tr class="highlight-row">
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $transaction->shoe->namamerk }}</td>
                        <td>{{ $transaction->shoe->tipe }}</td>
                        <td>{{ $transaction->jumlah }}</td>
                        <td>Rp {{ number_format($transaction->shoe->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('transaksi.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="text-right"><strong>Total Seluruh:</strong></td>
                    <td class="highlight-total">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    @endsection
    <!-- Script dan Stylesheet -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
</body>
</html>
