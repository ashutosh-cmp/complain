@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Subject: {{ $subject->name }}</h4>
                        </div>
                        <div class="card-body">
                            <h4>Name</h4>
                            <p>{{ $subject->name }}</p>
                            <h4>Description</h4>
                            <p>{!! $subject->description !!}</p>
                            <h4>Order</h4>
                            <p>{{ $subject->order }}</p>
                            <h4>Status</h4>
                            <p>{{ $subject->status == 1 ? 'Active' : 'In Active' }}</p>
                            <h4>Created By User</h4>
                            <p>{{ $subject->creator->name }}</p>
                            <a href="{{ url('/subjects/' . $subject->id . '/edit') . '?' . http_build_query($filters) }}"
                                class="btn btn-primary">Edit</a>
                            <a href="{{ url('/subjects?' . http_build_query($filters)) }}" class="btn btn-secondary">Back to
                                list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
