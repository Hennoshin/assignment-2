@extends('layouts.default')

@section('content')
    @php
        $module = "Cuti & Ijin"
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Edit
    </h4>
    <div class="card mb-4">
        <div class="card-body">
        @include('components.alert.error-field')
            <form method="post" action="{{ route('web.paid-leaves.update', ["id" => $row->uuid]) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.paid-leaves.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    @endsection
