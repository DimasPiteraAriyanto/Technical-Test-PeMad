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
                        Edit Job Type
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jobTypes.index') }}">Job Types</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('jobTypes.update', $jobType->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="row">

            <div class="col-xl-12">
                <!-- BEGIN: Job Type Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Job Type Details
                    </div>
                    <div class="card-body">
                        <!-- Form Group (name) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="name_type_job">Job Type Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('name_type_job') is-invalid @enderror" id="name_type_job" name="name_type_job" type="text" placeholder="" value="{{ old('name', $jobType->name_type_job) }}" autocomplete="off" />
                            @error('name_type_job')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('jobTypes.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Job Type Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
