<!-- resources/views/companies/index.blade.php -->
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
            <a href="{{ route('companies.create') }}" class="btn btn-primary">Add New</a>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                    <tr>
                        {{-- <td><img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo"></td> --}}
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->website }}</td>
                        <td>
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{-- Paginate --}}
            @if ($companies->lastPage() > 1)
                <ul class="pagination">
                    <li class="page-item {{ ($companies->currentPage() == 1) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $companies->url(1) }}">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $companies->lastPage(); $i++)
                        <li class="page-item {{ ($companies->currentPage() == $i) ? ' active' : '' }}">
                            <a class="page-link" href="{{ $companies->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ ($companies->currentPage() == $companies->lastPage()) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $companies->url($companies->currentPage()+1) }}">Next</a>
                    </li>
                </ul>
            @endif

        </div>
    </div>
</div>
@endsection
