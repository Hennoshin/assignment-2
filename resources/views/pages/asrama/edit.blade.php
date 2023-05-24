@extends('layouts.default')

@section('content')
    @php
        $module = 'Asrama';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Ubah {{ $row->title }}
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.asrama.update', ['id' => $row->uuid]) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'title',
                            'label' => 'Nama Asrama',
                            'value' => old('title', $row->title),
                            'placeholder' => 'Nama Asrama',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.text_area', [
                            'class_group' => 'mb-3',
                            'field_name' => 'description',
                            'label' => 'Deskripsi',
                            'value' => old('description', $row->description),
                            'placeholder' => 'Deskripsi',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'address',
                            'label' => 'Alamat',
                            'value' => old('address', $row->address),
                            'placeholder' => 'Alamat',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.text_area', [
                            'class_group' => 'mb-3',
                            'field_name' => 'lokasi',
                            'label' => 'Lokasi',
                            'value' => old('lokasi', $row->lokasi),
                            'placeholder' => 'Lokasi',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.image', [
                            'class_group' => 'mb-3',
                            'field_name' => 'images[]',
                            'label' => 'Gambar',
                            'value' => '',
                            'placeholder' => 'Gambar',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                            'multiple' => true,
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
