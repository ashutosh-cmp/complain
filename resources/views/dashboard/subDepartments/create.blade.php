@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add SubDepartment</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('subDepartments.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="department_id">Department</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="department_id" name="department_id">
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}" @selected(old('department_id') == $department->id)>
                                                    {{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="name">SubDepartment Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('name') is-invalid @enderror" id="name"
                                            type="text" name="name" placeholder="Enter subDepartment..." length="160"
                                            autocomplete="subDepartment" autofocus required value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit">Add</button>
                                <a href="{{ route('subDepartments.index') }}" class="btn btn-primary">Return</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
