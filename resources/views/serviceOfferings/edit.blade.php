@extends('dashboard.body.main')

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-folder"></i></div>
                        Edit Service Offering
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('serviceOfferings.index') }}">Project</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('serviceOfferings.update', $serviceOffering->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="row">

            <div class="col-xl-12">
                <!-- BEGIN: Project  Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Project  Details
                    </div>
                    <div class="card-body"> <!-- Company Name -->
                        <div class="mb-3">
                            <label class="small mb-1" for="company_id">Company Name <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid @error('company_id') is-invalid @enderror" id="company_id" name="company_id">
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id', $serviceOffering->company_id) == $company->id ? 'selected' : '' }}>
                                        {{ $company->name_company }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Job Name -->
                        <div class="mb-3">
                            <label class="small mb-1" for="job_id">Job Name <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid @error('job_id') is-invalid @enderror" id="job_id" name="job_id">
                                <option value="">Select Job</option>
                                @foreach($jobs as $job)
                                    <option value="{{ $job->id }}" {{ old('job_id', $serviceOffering->job_id) == $job->id ? 'selected' : '' }}>
                                        {{ $job->name_job }}
                                    </option>
                                @endforeach
                            </select>
                            @error('job_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Price Service Offering -->
                        <div class="mb-3">
                            <label class="small mb-1" for="price_service_offerings">Price <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('price_service_offerings') is-invalid @enderror" id="price_service_offerings" name="price_service_offerings" type="number" value="{{ old('price_service_offerings', $serviceOffering->price_service_offerings) }}" autocomplete="off" />
                            @error('price_service_offerings')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Detail Service Offering -->
                        <div class="mb-3">
                            <label class="small mb-1" for="detail_service_offerings">Service Offering Detail</label>
                            <textarea class="form-control form-control-solid @error('detail_service_offerings') is-invalid @enderror" id="detail_service_offerings" name="detail_service_offerings" rows="4">{{ old('detail_service_offerings', $serviceOffering->detail_service_offerings) }}</textarea>
                            @error('detail_service_offerings')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('serviceOfferings.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Project  Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
