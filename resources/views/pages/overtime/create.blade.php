@extends('layouts.default')

@section('content')
    @php
        $module = 'Lemburan';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Create New
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.overtime.store') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <input type="hidden" name="employee_id" value="{{ auth()->user()->employee->uuid }}">
                <div class="row">
                    <div class="col-md-6">

                        @include('components.form.text_area', [
                            'class_group' => 'mb-3',
                            'field_name' => 'description',
                            'label' => 'Description',
                            'value' => old('description', null),
                            'placeholder' => 'Description',
                            'show' => true,
                            'disable' => false,
                        ])

                    </div>
                    <div class="col-md-6">

                        <div class="row">
                            <div class="col">
                                @include('components.form.date', [
                                    'class_group' => 'mb-3',
                                    'field_name' => 'start_date',
                                    'label' => 'Start Leave',
                                    'value' => old('start_date'),
                                    'placeholder' => 'Start Leave',
                                    'show' => true,
                                    'required' => true,
                                    'disable' => false,
                                    'accept' => null,
                                ])
                            </div>
                            <div class="col">
                                @include('components.form.time', [
                                    'class_group' => 'mb-3',
                                    'field_name' => 'start_time',
                                    'label' => 'Start Time',
                                    'value' => old('start_time'),
                                    'placeholder' => 'Start Time',
                                    'show' => true,
                                    'required' => true,
                                    'disable' => false,
                                    'accept' => null,
                                ])
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                @include('components.form.date', [
                                    'class_group' => 'mb-3',
                                    'field_name' => 'end_date',
                                    'label' => 'End Leave',
                                    'value' => old('end_date'),
                                    'placeholder' => 'End Leave',
                                    'show' => true,
                                    'required' => true,
                                    'disable' => false,
                                    'accept' => null,
                                ])
                            </div>
                            <div class="col">
                                @include('components.form.time', [
                                    'class_group' => 'mb-3',
                                    'field_name' => 'end_time',
                                    'label' => 'End Time',
                                    'value' => old('end_time'),
                                    'placeholder' => 'End Time',
                                    'show' => true,
                                    'required' => true,
                                    'disable' => false,
                                    'accept' => null,
                                ])
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.overtime.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    @endsection
