@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Dashboard Card -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Cards for Companies and Employees -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Companies</div>
                <div class="card-body">
                    <h5 class="card-title">Manage Companies</h5>
                    <p class="card-text">Click di sini untuk melihat, menambah, edit dan delete data</p>
                    <a href="{{ route('companies.index') }}" class="btn btn-primary">Go to Companies</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Employees</div>
                <div class="card-body">
                    <h5 class="card-title">Manage Employees</h5>
                    <p class="card-text">Click di sini untuk melihat, menambah, edit dan delete data</p>
                    <a href="{{ route('employees.index') }}" class="btn btn-primary">Go to Employees</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
