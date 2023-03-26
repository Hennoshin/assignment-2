@extends('layouts.default')

@section('content')
    @php
        $module = 'Gaji';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Import
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.salaries.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        @include('components.form.file', [
                            'class_group' => 'mb-3',
                            'field_name' => 'file',
                            'label' => 'file',
                            'value' => old('file', null),
                            'placeholder' => 'file',
                            'accept' => ".xlsx",
                            'show' => true,
                            'disable' => false,
                        ])
                        <small> Format import <a href="{{ asset('assets/import-gaji.xlsx') }}">Download Format .xLsx</a></small>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.salaries.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    @endsection
