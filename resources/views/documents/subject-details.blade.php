@extends('documents.base')
@section('content')
    <div>
        <h1>Subject Details</h1>
        <p>Date: {{ now()->toFormattedDateString() }}</p>
    </div>

    <div class="content">
        <h4>Subject: {{ $data['name'] }}</h4>
        <p><strong>Name:</strong> {{ $data['name'] }}</p>
        <p><strong>Description:</strong> {!! $data['description'] !!}</p>
        <p><strong>Order:</strong> {{ $data['order'] }}</p>
        <p><strong>Status:</strong> {{ $data['status'] == 1 ? 'Active' : 'Inactive' }}</p>
        <p><strong>Created By:</strong> {{ $data['creator']['name'] }}</p>
    </div>
@endsection
