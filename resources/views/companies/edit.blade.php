@extends('dashboard.body.main')

@section('specificpagescripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endsection

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-users"></i></div>
                        Edit Supplier
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Suppliers</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xl-12">
                <!-- BEGIN: Supplier Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Supplier Details
                    </div>
                    <div class="card-body">
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="small mb-1" for="name_company">Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('name_company') is-invalid @enderror" id="name_company" name="name_company" type="text" value="{{ old('name_company', $company->name_company) }}" />
                            @error('name_company')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="small mb-1" for="email_company">Email <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('email_company') is-invalid @enderror" id="email_company" name="email_company" type="email" value="{{ old('email_company', $company->email_company) }}" />
                            @error('email_company')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Account Bank -->
                        <div class="mb-3">
                            <label class="small mb-1" for="account_bank_company">Account Bank <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('account_bank_company') is-invalid @enderror" id="account_bank_company" name="account_bank_company" type="text" value="{{ old('account_bank_company', $company->account_bank_company) }}" />
                            @error('account_bank_company')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label class="small mb-1" for="phone_company">Phone <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('phone_company') is-invalid @enderror" id="phone_company" name="phone_company" type="text" value="{{ old('phone_company', $company->phone_company) }}" />
                            @error('phone_company')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a class="btn btn-danger" href="{{ route('companies.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Supplier Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
