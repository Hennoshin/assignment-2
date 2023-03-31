@extends('layouts.default')

@section('content')
    @php
        $module = 'Asrama';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Create New
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.asrama.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'title',
                            'label' => 'Nama Asrama',
                            'value' => '',
                            'placeholder' => 'Nama Asrama',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
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

                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'status',
                            'label' => 'Status',
                            'value' => old('status', null),
                            'placeholder' => 'Status',
                            'options' => [
                                [
                                    'value' => '0',
                                    'label' => 'Draft',
                                ],
                                [
                                    'value' => '1',
                                    'label' => 'Publish',
                                ],
                                [
                                    'value' => '2',
                                    'label' => 'Held',
                                ],
                            ],
                            'key_option_value' => 'value',
                            'key_option_label' => 'label',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('components.form.date', [
                            'class_group' => 'mb-3',
                            'field_name' => 'start_date',
                            'label' => 'Informasi Tanggal',
                            'value' => old('start_date'),
                            'placeholder' => 'Informasi Tanggal',
                            'show' => true,
                            'required' => true,
                            'disable' => false,
                            'accept' => null,
                        ])

                        @include('components.form.date', [
                            'class_group' => 'mb-3',
                            'field_name' => 'end_date',
                            'label' => 'Informasi Tanggal Selesai',
                            'value' => old('end_date'),
                            'placeholder' => 'Informasi Tanggal Selesai',
                            'show' => true,
                            'required' => true,
                            'disable' => false,
                            'accept' => null,
                        ])
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.asrama.index') }}">Batal</a>
                </div>
            </form>
        </div>
    @endsection
