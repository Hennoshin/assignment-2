@extends('layouts.default')

@section('content')
    @php
        $module = "Pegawai"
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Ubah {{$row->name}}
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.employees.update', ["id" => $row->uuid]) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-12">
                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'unit_kerja_id',
                            'label' => 'Unit Kerja',
                            'value' => old('unit_kerja_id', $row->unitKerja->uuid),
                            'placeholder' => 'Unit Kerja',
                            'show' => true,
                            'options' => \App\Models\UnitKerja::all(),
                            'key_option_value' => 'uuid',
                            'key_option_label' => 'title',
                            'required' => true,
                            'disable' => false,
                            'accept' => null,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'nip',
                            'label' => 'Nip',
                            'value' => old('nip', $row->nip),
                            'placeholder' => 'Nip',
                            'show' => true,
                            'required' => true,
                            'disable' => true,
                            'accept' => null,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'name',
                            'label' => 'Name',
                            'value' => old('name', $row->name),
                            'placeholder' => 'Name',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'email',
                            'label' => 'Email',
                            'value' => old('email', $row->user?->email),
                            'placeholder' => 'Email',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'alias',
                            'label' => 'Alias',
                            'value' => old('alias', $row->alias),
                            'placeholder' => 'Alias',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'phone',
                            'label' => 'Phone',
                            'value' => old('Phone', $row->phone),
                            'placeholder' => 'phone',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'gender',
                            'label' => 'Gender',
                            'value' => old('gender', $row->gender),
                            'placeholder' => 'Gender',
                            'options' => [
                                [
                                    'value' => 'L',
                                    'label' => 'Laki-laki',
                                ],
                                [
                                    'value' => 'P',
                                    'label' => 'Perempuan',
                                ],
                            ],
                            'key_option_value' => 'value',
                            'key_option_label' => 'label',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])
                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'tempat',
                            'label' => 'Tempat',
                            'value' => old('tempat', $row->tempat),
                            'placeholder' => 'Tempat',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])
                        @include('components.form.date', [
                            'class_group' => 'mb-3',
                            'field_name' => 'dob',
                            'label' => 'Tanggal Lahir',
                            'value' => old('dob', $row->dob),
                            'placeholder' => 'Tanggal Lahir',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.employees.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    @endsection
