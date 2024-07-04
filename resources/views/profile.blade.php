@extends('layouts.app')

@section('title', 'Profile Settings')

@section('contents')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h1 class="text-3xl font-bold text-gray-900">
                        Profile Settings
                    </h1>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name : </label>
                            <input id="name" name="name" type="text" value="{{ auth()->user()->name }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email : </label>
                            <input id="email" name="email" type="text" value="{{ auth()->user()->email }}" class="form-control">
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Save Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    