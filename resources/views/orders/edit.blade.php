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
                        Edit Order
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('orders.update', $language->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="row">

            <div class="col-xl-12">
                <!-- BEGIN: Order Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Order Details
                    </div>
                    <div class="card-body">
                        <!-- Name Order -->
                        <div class="mb-3">
                            <label class="small mb-1" for="name_order">Order Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('name_order') is-invalid @enderror" id="name_order" name="name_order" type="text" value="{{ old('name_order', $order->name_order) }}" />
                            @error('name_order')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Date Order -->
                        <div class="mb-3">
                            <label class="small mb-1" for="date_order">Order Date <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('date_order') is-invalid @enderror" id="date_order" name="date_order" type="date" value="{{ old('date_order', $order->date_order) }}" />
                            @error('date_order')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Detail Order -->
                        <div class="mb-3">
                            <label class="small mb-1" for="detail_order">Order Detail <span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-solid @error('detail_order') is-invalid @enderror" id="detail_order" name="detail_order" rows="4">{{ old('detail_order', $order->detail_order) }}</textarea>
                            @error('detail_order')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Total Order -->
                        <div class="mb-3">
                            <label class="small mb-1" for="total_order">Total Order <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('total_order') is-invalid @enderror" id="total_order" name="total_order" type="number" value="{{ old('total_order', $order->total_order) }}" />
                            @error('total_order')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Status Order -->
                        <div class="mb-3">
                            <label class="small mb-1">Status Order <span class="text-danger">*</span></label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="status_order_pending" name="status_order" value="0" {{ old('status_order', $order->status_order) == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_order_pending">Pending</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="status_order_success" name="status_order" value="1" {{ old('status_order', $order->status_order) == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_order_success">Success</label>
                            </div>
                            @error('status_order')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('orders.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Order Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection
