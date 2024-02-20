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
                        Edit Project
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Project</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="row">

            <div class="col-xl-12">
                <!-- BEGIN: Project  Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Project  Details
                    </div>
                    <div class="card-body">
                        <!-- Project Type Name -->
                        <div class="mb-3">
                            <label class="small mb-1" for="name_project">Project Type Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('name_project') is-invalid @enderror" id="name_project" name="name_project" type="text" value="{{ old('name_project', $project->name_project) }}" autocomplete="off" />
                            @error('name_project')
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
                                    <option value="{{ $job->id }}" {{ old('job_id', $project->job_id) == $job->id ? 'selected' : '' }}>
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

                        <!-- Start Date Project -->
                        <div class="mb-3">
                            <label class="small mb-1" for="start_date_project">Start Date <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('start_date_project') is-invalid @enderror" id="start_date_project" name="start_date_project" type="date" value="{{ old('start_date_project', $project->start_date_project) }}" autocomplete="off" />
                            @error('start_date_project')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- End Date Project -->
                        <div class="mb-3">
                            <label class="small mb-1" for="end_date_project">End Date <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('end_date_project') is-invalid @enderror" id="end_date_project" name="end_date_project" type="date" value="{{ old('end_date_project', $project->end_date_project) }}" autocomplete="off" />
                            @error('end_date_project')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Price Project -->
                        <div class="mb-3">
                            <label class="small mb-1" for="price_project">Price <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('price_project') is-invalid @enderror" id="price_project" name="price_project" type="text" value="{{ old('price_project', $project->price_project) }}" autocomplete="off" />
                            @error('price_project')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Detail Project -->
                        <div class="mb-3">
                            <label class="small mb-1" for="detail_project">Project Detail</label>
                            <textarea class="form-control form-control-solid @error('detail_project') is-invalid @enderror" id="detail_project" name="detail_project" rows="4">{{ old('detail_project', $project->detail_project) }}</textarea>
                            @error('detail_project')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('projects.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Project  Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
