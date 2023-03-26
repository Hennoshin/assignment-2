@extends('layouts.default')

@section('content')
    @php
        $module = 'Cuti & Ijin';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Detail
        {{ $row->employee->name ?? null . ' - ' . $row->type->title ?? null }}
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            @include('components.form.input', [
                'class_group' => 'mb-3',
                'field_name' => 'employee_id',
                'label' => 'Employee',
                'value' => old('employee_id', $row->employee->name ?? null),
                'placeholder' => 'Employe',
                'show' => true,
                'required' => true,
                'disabled' => true,
                'accept' => null,
            ])
            @include('components.form.input', [
                'class_group' => 'mb-3',
                'field_name' => 'type_id',
                'label' => 'type_id',
                'value' => old('type_id', $row->type->title ?? null),
                'placeholder' => 'type',
                'show' => true,
                'required' => true,
                'disabled' => true,
                'accept' => null,
            ])
            <div class="row">
                <div class="col-6">
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
                <div class="col-6">
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
                <div class="col">
                    @php
                        $file = $row->file()->first();
                    @endphp
                    <a href="{{ empty($file) ? "" : route('web.getfiles') }}?_path={{ $file?->path }}" target="_blank">Download File</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Approve Cuti / Ijin</span>
            </h5>
            <form method="post" action="{{ route('web.paid-leaves.approve', ['id' => $row->uuid]) }}"
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
                        @if ($row->approve_status == 0 AND auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN))
                        <button type="submit" class="btn btn-primary">Save</button>
                        @endif
                        <a type="button" class="btn btn-secondary" href="{{ route('web.paid-leaves.index') }}">Back</a>
                    </div>
            </form>
        </div>
    </div>
@endsection
