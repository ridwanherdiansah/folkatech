<!-- resources/views/companies/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Menampilkan Notifikasi Sukses -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Menampilkan Notifikasi Error -->
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Menampilkan Pesan Validasi Error -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Create Company') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">Company Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group mt-3">
                            <label for="logo">Company Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                        </div>

                        <div class="form-group mt-3">
                            <label for="website">Company Website</label>
                            <input type="url" class="form-control" id="website" name="website">
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Create Company</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
