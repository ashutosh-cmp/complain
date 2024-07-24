@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Student</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('students.update', $student->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Name</label>
                                <input class="form-control" type="text" placeholder="Name" name="name" required autofocus value="{{ $student->name }}" />
                            </div>
                            <div class="form-group row">
                                <label>Mobile Number</label>
                                <input class="form-control" type="text" placeholder="Mobile Number" name="mobile_number" required value="{{ $student->mobile_number }}" />
                            </div>
                            <div class="form-group row">
                                <label>Roll Number</label>
                                <input class="form-control" type="text" placeholder="Roll Number" name="roll_number" required value="{{ $student->roll_number }}" />
                            </div>
                            <button class="btn btn-success" type="submit">Edit</button>
                            <a href="{{ route('students.index') }}" class="btn btn-primary">Return</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection