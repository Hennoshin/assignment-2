@extends('layouts.default')

@section('content')
    @php
        $module = 'Tipe Kamar';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Tambah Tipe Kamar
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.informations.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'title',
                            'label' => 'Tipe Kamar',
                            'value' => '',
                            'placeholder' => 'Tipe Kamar',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.text_area', [
                            'class_group' => 'mb-3',
                            'field_name' => 'description',
                            'label' => 'Deskripsi',
                            'value' => old('description', null),
                            'placeholder' => 'Deskripsi',
                            'show' => true,
                            'disable' => false,
                        ])
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.room-type.index') }}">Batal</a>
                </div>
            </form>
        </div>
    @endsection
