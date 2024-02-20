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
                        Edit Service Request
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('serviceRequests.index') }}">Service Request</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('serviceRequests.update', $serviceRequest->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="row">

            <div class="col-xl-12">
                <!-- BEGIN: Service Request  Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Service Request  Details
                    </div>
                    <div class="card-body">
                        <!-- Job -->
                        <div class="mb-3">
                            <label class="small mb-1" for="job_id">Job <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid @error('job_id') is-invalid @enderror" id="job_id" name="job_id">
                                <option value="">Select Job</option>
                                @foreach($jobs as $job)
                                    <option value="{{ $job->id }}" {{ old('job_id', $serviceRequest->job_id) == $job->id ? 'selected' : '' }}>
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

                        <!-- Company -->
                        <div class="mb-3">
                            <label class="small mb-1" for="company_id">Company <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid @error('company_id') is-invalid @enderror" id="company_id" name="company_id">
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id', $serviceRequest->company_id) == $company->id ? 'selected' : '' }}>
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


                        <!-- Name Service Request -->
                        <div class="mb-3">
                            <label class="small mb-1" for="name_service_request">Service Request Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('name_service_request') is-invalid @enderror" id="name_service_request" name="name_service_request" type="text" value="{{ old('name_service_request', $serviceRequest->name_service_request) }}" />
                            @error('name_service_request')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Start Date Service Request -->
                        <div class="mb-3">
                            <label class="small mb-1" for="start_date_service_request">Start Date Service Request <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('start_date_service_request') is-invalid @enderror" id="start_date_service_request" name="start_date_service_request" type="date" value="{{ old('start_date_service_request', $serviceRequest->start_date_service_request) }}" />
                            @error('start_date_service_request')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- End Date Service Request -->
                        <div class="mb-3">
                            <label class="small mb-1" for="end_date_service_request">End Date Service Request <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('end_date_service_request') is-invalid @enderror" id="end_date_service_request" name="end_date_service_request" type="date" value="{{ old('end_date_service_request', $serviceRequest->end_date_service_request) }}" />
                            @error('end_date_service_request')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Price Service Request -->
                        <div class="mb-3">
                            <label class="small mb-1" for="price_service_request">Price Service Request <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('price_service_request') is-invalid @enderror" id="price_service_request" name="price_service_request" type="number" value="{{ old('price_service_request', $serviceRequest->price_service_request) }}" />
                            @error('price_service_request')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Detail Service Request -->
                        <div class="mb-3">
                            <label class="small mb-1" for="detail_service_request">Service Request Detail <span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-solid @error('detail_service_request') is-invalid @enderror" id="detail_service_request" name="detail_service_request" rows="4">{{ old('detail_service_request', $serviceRequest->detail_service_request) }}</textarea>
                            @error('detail_service_request')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('serviceRequests.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Service Request  Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
