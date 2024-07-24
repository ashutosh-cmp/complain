@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student: {{ $student->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h4>Name</h4>
                        <p>{{ $student->name }}</p>
                        <h4>Subject</h4>
                        <p>{{ $student->mobile_number }}</p>
                        <h4>Content</h4>
                        <p>{{ $student->roll_number }}</p>
                        <a href="{{ route('students.index') }}" class="btn btn-primary">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection