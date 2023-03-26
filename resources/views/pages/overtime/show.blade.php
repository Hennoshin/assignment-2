@extends('layouts.default')

@section('content')
    @php
        $module = 'Lemburan';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Detail
        {{ $row->employee->name }}
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            @include('components.form.input', [
                'class_group' => 'mb-3',
                'field_name' => 'employee_id',
                'label' => 'Employee',
                'value' => old('employee_id', $row->employee->name),
                'placeholder' => 'Employe',
                'show' => true,
                'required' => true,
                'disabled' => true,
                'accept' => null,
            ])

            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col">
                            @include('components.form.input', [
                                'class_group' => 'mb-3',
                                'field_name' => 'start_date',
                                'label' => 'Start',
                                'value' => old('start_date', date('d-m-Y', strtotime($row->start_date))),
                                'placeholder' => 'Start',
                                'show' => true,
                                'required' => true,
                                'disabled' => true,
                                'accept' => null,
                            ])
                        </div>
                        <div class="col">
                            @include('components.form.input', [
                                'class_group' => 'mb-3',
                                'field_name' => 'start_time',
                                'label' => 'Time',
                                'value' => old('start_time', $row->start_time),
                                'placeholder' => 'Time',
                                'show' => true,
                                'required' => true,
                                'disabled' => true,
                                'accept' => null,
                            ])
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col">
                            @include('components.form.input', [
                                'class_group' => 'mb-3',
                                'field_name' => 'end_date',
                                'label' => 'End',
                                'value' => old('end_date', date('d-m-Y', strtotime($row->end_date))),
                                'placeholder' => 'End',
                                'show' => true,
                                'required' => true,
                                'disabled' => true,
                                'accept' => null,
                            ])
                        </div>
                        <div class="col">
                            @include('components.form.input', [
                                'class_group' => 'mb-3',
                                'field_name' => 'end_time',
                                'label' => 'Time',
                                'value' => old('end_time', $row->end_time),
                                'placeholder' => 'Time',
                                'show' => true,
                                'required' => true,
                                'disabled' => true,
                                'accept' => null,
                            ])
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @include('components.form.text_area', [
                        'class_group' => 'mb-3',
                        'field_name' => 'description',
                        'label' => 'Description',
                        'value' => old('description', $row->description),
                        'placeholder' => 'Description',
                        'show' => true,
                        'disabled' => true,
                    ])
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Progress Lemburan</span>
            </h5>
            <form method="post" action="{{ route('web.overtime.progress', ['id' => $row->uuid]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        @include('components.form.text_area', [
                            'class_group' => 'mb-3',
                            'field_name' => 'progress',
                            'label' => 'Progress Lembur',
                            'value' => old('progress', $row->progress),
                            'placeholder' => 'Progress Lembur',
                            'show' => true,
                            'disabled' => false,
                        ])
                    </div>
                </div>
                <div class="form-group">
                    @if (
                        $row->approve_status == 0 and
                            auth()->user()->hasRole(\App\Constants\RoleConst::STAFF))
                        <button type="submit" class="btn btn-primary">Save Progress</button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Approve Lemburan</span>
            </h5>
            <form method="post" action="{{ route('web.overtime.approve', ['id' => $row->uuid]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'approve_status',
                            'label' => 'Is Approve',
                            'value' => old('approve_status', $row->approve_status),
                            'placeholder' => 'Is Approve',
                            'show' => true,
                            'options' => [
                                ['label' => 'APPROVE', 'value' => 1],
                                ['label' => 'Reject', 'value' => 2],
                            ],
                            'key_option_value' => 'value',
                            'key_option_label' => 'label',
                            'required' => true,
                            'disabled' => $row->approve_status == 0 ? false : true,
                            'accept' => null,
                        ])
                    </div>
                    <div class="col-12">
                        @include('components.form.text_area', [
                            'class_group' => 'mb-3',
                            'field_name' => 'approve_notes',
                            'label' => 'Notes',
                            'value' => old('approve_notes', $row->approve_notes),
                            'placeholder' => 'Notes',
                            'show' => true,
                            'disabled' => $row->approve_status == 0 ? false : true,
                        ])
                    </div>
                </div>
                <div class="form-group">
                    @if (
                        $row->approve_status == 0 and
                            auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN))
                        <button type="submit" class="btn btn-primary">Save</button>
                    @endif
                    <a type="button" class="btn btn-secondary" href="{{ route('web.overtime.index') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
