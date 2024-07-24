@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Student</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('students.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label>Name</label>
                                <input class="form-control" type="text" placeholder="Name" name="name" required autofocus />
                            </div>
                            <div class="form-group row">
                                <label>Mobile Number</label>
                                <input class="form-control" type="text" placeholder="Mobile Number" name="mobile_number" required />
                            </div>
                            <div class="form-group row">
                                <label>Roll Number</label>
                                <input class="form-control" type="text" placeholder="Roll Number" name="roll_number" required />
                            </div>
                            <button class="btn btn-success" type="submit">Add</button>
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