@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>department: {{ $department->name }}</h4>
                        </div>
                        <div class="card-body">
                            <h4>Name</h4>
                            <p>{{ $department->name }}</p>
                            
                            <h4>Status</h4>
                            <p>{{ $department->status == 1 ? 'Active' : 'In Active' }}</p>
                            
                            <a href="{{ url('/departments/' . $department->id . '/edit') . '?' . http_build_query($filters) }}"
                                class="btn btn-primary">Edit</a>
                            <a href="{{ url('/departments?' . http_build_query($filters)) }}" class="btn btn-secondary">Back to
                                list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
