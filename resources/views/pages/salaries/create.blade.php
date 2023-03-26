@extends('layouts.default')

@section('content')
    @php
        $module = 'Gaji';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Create New
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.salaries.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'employee_id',
                            'label' => 'Employee',
                            'value' => old('employee_id'),
                            'placeholder' => 'Employee',
                            'show' => true,
                            'options' => \App\Models\Employee::all(),
                            'key_option_value' => 'uuid',
                            'key_option_label' => 'name',
                            'required' => true,
                            'disable' => false,
                            'accept' => null,
                        ])

                        @include('components.form.date', [
                            'class_group' => 'mb-3',
                            'field_name' => 'bulan',
                            'label' => 'Tanggal',
                            'value' => old('bulan'),
                            'placeholder' => 'Tanggal',
                            'show' => true,
                            'required' => true,
                            'disable' => false,
                            'accept' => null,
                        ])

                        @include('components.form.number', [
                            'class_group' => 'mb-3',
                            'field_name' => 'gaji_pokok',
                            'label' => 'Gaji Pokok',
                            'value' => old('gaji_pokok', null),
                            'placeholder' => 'Gaji Pokok',
                            'min' => 0,
                            'max' => 999999999999,
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                        @include('components.form.number', [
                            'class_group' => 'mb-3',
                            'field_name' => 'uang_beras',
                            'label' => 'Uang Beras',
                            'value' => old('uang_beras', null),
                            'placeholder' => 'Uang Beras',
                            'min' => 0,
                            'max' => 999999999999,
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                    </div>
                    <div class="col-md-6">
                        @include('components.form.number', [
                            'class_group' => 'mb-3',
                            'field_name' => 'uang_makan',
                            'label' => 'Uang Makan',
                            'value' => old('uang_makan', null),
                            'placeholder' => 'Uang Makan',
                            'min' => 0,
                            'max' => 999999999999,
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                        @include('components.form.number', [
                            'class_group' => 'mb-3',
                            'field_name' => 'lembur',
                            'label' => 'Lembur',
                            'value' => old('lembur', null),
                            'placeholder' => 'Lembur',
                            'min' => 0,
                            'max' => 999999999999,
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                        @include('components.form.number', [
                            'class_group' => 'mb-3',
                            'field_name' => 'tunjangan',
                            'label' => 'Tunjangan',
                            'value' => old('tunjangan', null),
                            'placeholder' => 'Tunjangan',
                            'min' => 0,
                            'max' => 999999999999,
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                        @include('components.form.number', [
                            'class_group' => 'mb-3',
                            'field_name' => 'hutang',
                            'label' => 'Hutang',
                            'value' => old('hutang', null),
                            'placeholder' => 'Hutang',
                            'min' => 0,
                            'max' => 999999999999,
                            'show' => true,
                            'accept' => null,
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
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.salaries.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    @endsection
