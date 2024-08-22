@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Employee') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('employees.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="company">Company</label>
                            <select class="form-control" id="company" name="company_id" required>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">Employee Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group mt-3">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Create Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
