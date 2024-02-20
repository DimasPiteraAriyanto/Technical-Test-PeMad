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
                        Add Bill
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('bills.index') }}">Bills</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('bills.store') }}" method="POST">
        @csrf
        <div class="row">

            <div class="col-xl-12">
                <!-- BEGIN: Category Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Bill Details
                    </div>
                    <div class="card-body">
                        <!-- Project ID -->
                        <div class="mb-3">
                            <label class="small mb-1" for="project_id">Project <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid @error('project_id') is-invalid @enderror" id="project_id" name="project_id">
                                <option value="">Select Project</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name_project }}</option>
                                @endforeach
                            </select>
                            @error('project_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Service Request ID -->
                        <div class="mb-3">
                            <label class="small mb-1" for="service_request_id">Service Request <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid @error('service_request_id') is-invalid @enderror" id="service_request_id" name="service_request_id">
                                <option value="">Select Service Request</option>
                                @foreach($serviceRequests as $serviceRequest)
                                    <option value="{{ $serviceRequest->id }}">{{ $serviceRequest->job->name_job }}</option>
                                @endforeach
                            </select>
                            @error('service_request_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Service Offering ID -->
                        <div class="mb-3">
                            <label class="small mb-1" for="service_offering_id">Service Offering <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid @error('service_offering_id') is-invalid @enderror" id="service_offering_id" name="service_offering_id">
                                <option value="">Select Service Offering</option>
                                @foreach($serviceOfferings as $serviceOffering)
                                    <option value="{{ $serviceOffering->id }}">{{ $serviceOffering->job->job_name }}</option>
                                @endforeach
                            </select>
                            @error('service_offering_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Total Price -->
                        <div class="mb-3">
                            <label class="small mb-1" for="total_price">Total Price <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('total_price') is-invalid @enderror" id="total_price" name="total_price" type="number" value="{{ old('total_price') }}" />
                            @error('total_price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Status Bill -->
                        <div class="mb-3">
                            <label class="small mb-1">Status Bill <span class="text-danger">*</span></label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="status_bill_pending" name="status_bill" value="0" {{ old('status_bill') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_bill_pending">Pending</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="status_bill_success" name="status_bill" value="1" {{ old('status_bill') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_bill_success">Success</label>
                            </div>
                            @error('status_bill')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Add</button>
                        <a class="btn btn-danger" href="{{ route('bills.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Category Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->

<script>
    // Slug Generator
    const title = document.querySelector("#name");
    const slug = document.querySelector("#slug");
    title.addEventListener("keyup", function() {
        let preslug = title.value;
        preslug = preslug.replace(/ /g,"-");
        slug.value = preslug.toLowerCase();
    });
</script>
@endsection
