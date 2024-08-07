@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Topic</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ url('/subDepartments/' . $subDepartment->id) . '?' . http_build_query($filters) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="department_id">Department</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="department_id" name="department_id">
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    @if ((old('department_id') ?? $subDepartment->department_id) == $department->id) selected @endif> {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="name">Sub Department</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="name" type="text" name="name"
                                            placeholder="Enter subDepartment..." autocomplete="subDepartment" autofocus required
                                            value="{{ old('name') ?? $subDepartment->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="order">Priority Order</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="order" type="number" name="order"
                                            placeholder="Enter Priority Order" step="0.01"
                                            value="{{ old('order', number_format($subDepartment->order, 2)) }}">
                                        @error('order')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Status</label>
                                    <div class="col-md-9 col-form-label">
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="active" type="radio" value="1"
                                                name="status" @checked(old('status', $subDepartment->status) == 1)>
                                            <label class="form-check-label" for="active">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="in-active" type="radio" value="0"
                                                name="status" @checked(old('status', $subDepartment->status) == 0)>
                                            <label class="form-check-label" for="in-active">In Active</label>
                                        </div>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit">Update</button>
                                <a href="{{ url('/subDepartments?' . http_build_query($filters)) }}" class="btn btn-secondary">Back
                                    to list</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
