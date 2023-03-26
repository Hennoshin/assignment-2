@extends('layouts.default')

@section('content')
    @php
        $module = 'Cuti & Ijin';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Create New
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.paid-leaves.store') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <input type="hidden" name="employee_id" value="{{ auth()->user()->employee->uuid }}">
                <div class="row">
                    <div class="col-md-6">

                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'paid_leave_type_id',
                            'label' => 'Type',
                            'value' => old('paid_leave_type_id'),
                            'placeholder' => 'Type',
                            'show' => true,
                            'options' => \App\Models\PaidLeaveType::get(),
                            'key_option_value' => 'uuid',
                            'key_option_label' => 'title',
                            'required' => true,
                            'disable' => false,
                            'accept' => null,
                        ])

                        @include('components.form.text_area', [
                            'class_group' => 'mb-3',
                            'field_name' => 'description',
                            'label' => 'Description',
                            'value' => old('description', null),
                            'placeholder' => 'Description',
                            'show' => true,
                            'disable' => false,
                        ])
                        
                        @include('components.form.file', [
                            'class_group' => 'mb-3',
                            'field_name' => 'file',
                            'label' => 'file',
                            'value' => old('file', null),
                            'placeholder' => 'file',
                            'accept' => null,
                            'show' => true,
                            'disable' => false,
                        ])
                    </div>
                    <div class="col-md-6">
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
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.paid-leaves.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    @endsection
