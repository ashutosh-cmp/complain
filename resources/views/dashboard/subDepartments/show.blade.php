@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sub-Department: {{ $subDepartment->name }}</h4>
                        </div>
                        <div class="card-body">
                            <h4>Department</h4>
                            <p>{{ $subDepartment->department->name }}</p>
                            <h4>Name</h4>
                            <p>{{ $subDepartment->name }}</p>
                            <h4>Order</h4>
                            <p>{{ $subDepartment->order }}</p>
                            <h4>Status</h4>
                            <p>{{ $subDepartment->status == 1 ? 'Active' : 'In Active' }}</p>
                            <h4>Created By User</h4>
                            <p>{{ $subDepartment->creator->name }}</p>
                            <a href="{{ url('/subDepartments/' . $subDepartment->id . '/edit') . '?' . http_build_query($filters) }}"
                                class="btn btn-primary">Edit</a>
                            <a href="{{ url('/subDepartments?' . http_build_query($filters)) }}" class="btn btn-secondary">Back to
                                list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
