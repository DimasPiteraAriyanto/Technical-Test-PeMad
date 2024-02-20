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
                        Edit Job
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jobs.index') }}">Jobs</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('jobs.update', $job->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="row">

            <div class="col-xl-12">
                <!-- BEGIN: Job  Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Job  Details
                    </div>
                    <div class="card-body">
                        <!-- Form Group (name) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="name_job">Job Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('name_job') is-invalid @enderror" id="name_job" name="name_job" type="text" placeholder="" value="{{ old('name', $job->name_job) }}" autocomplete="off" />
                            @error('name_job')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Form Group (job_type) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="job_type_id">Job Type Name <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid @error('job_type_id') is-invalid @enderror" id="job_type_id" name="job_type_id">
                                <option value="">Select Job Type</option>
                                @foreach($jobTypes as $jobType)
                                    <option value="{{ $jobType->id }}" {{ $job->jobTypes->id == $jobType->id ? 'selected' : '' }}>
                                        {{ $jobType->name_type_job }}
                                    </option>
                                @endforeach
                            </select>
                            @error('job_type_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('jobs.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Job  Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
