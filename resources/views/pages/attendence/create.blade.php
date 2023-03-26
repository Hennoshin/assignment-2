@extends('layouts.default')

@section('content')
    @php
        $module = "Attendences"
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Create New
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.attendence.quick-add-save', ['id' => $id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'status',
                            'label' => 'Status',
                            'value' => old('status', null),
                            'placeholder' => 'Status',
                            'options' => [
                                [
                                    'value' => 1,
                                    'label' => 'IN',
                                ],
                                [
                                    'value' => 2,
                                    'label' => 'OUT',
                                ],
                                [
                                    'value' => 3,
                                    'label' => 'LEMBUR',
                                ],
                            ],
                            'key_option_value' => 'value',
                            'key_option_label' => 'label',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                        @php
                            $lemburan = \App\Models\OverTime::where('employee_id', auth()->user()->employee->id)->where('approve_status', 1)->get();
                            $optLemburan = [];
                            foreach ($lemburan as $key => $value) {
                                $optLemburan[$key]['_title'] = $value['start_date'].' '.$value['start_time'].' - '.$value['end_date'].' '.$value['end_time'];
                                $optLemburan[$key]['_uuid'] = $value['uuid'];
                            }
                        @endphp

                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'lembur',
                            'label' => 'Absen Untuk Lemburan',
                            'value' => old('lembur', null),
                            'placeholder' => 'Absen Untuk Lemburan',
                            'options' => $optLemburan,
                            'key_option_value' => '_uuid',
                            'key_option_label' => '_title',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])
                        <small>Isikan Lemburan anda. Jika Status = 'LEMBUR' Jika anda Ingin Absen Lembur</small>

                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.attendence.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    @endsection
