<!-- resources/views/employees/index.blade.php -->
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
    <a href="{{ route('employees.create') }}" class="btn btn-primary">Add New</a>
    <table class="table">
        <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Company</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->firstname }}</td>
                <td>{{ $employee->lastname }}</td>
                <td>{{ $employee->company->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
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
    @if ($employees->lastPage() > 1)
        <ul class="pagination">
            <li class="page-item {{ ($employees->currentPage() == 1) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $employees->url(1) }}">Previous</a>
            </li>
            @for ($i = 1; $i <= $employees->lastPage(); $i++)
                <li class="page-item {{ ($employees->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $employees->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ ($employees->currentPage() == $employees->lastPage()) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $employees->url($employees->currentPage()+1) }}">Next</a>
            </li>
        </ul>
    @endif
</div>
@endsection
