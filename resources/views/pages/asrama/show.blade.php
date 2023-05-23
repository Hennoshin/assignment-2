@extends('layouts.default')

@section('content')
    @php
        $module = 'Asrama';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> View {{ $row->title }}
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.asrama.show', ['id' => $row->uuid]) }}" enctype="multipart/form-data">
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
                            'disabled' => true,
                        ])

                        @include('components.form.text_area', [
                            'class_group' => 'mb-3',
                            'field_name' => 'description',
                            'label' => 'Deskripsi',
                            'value' => old('description', $row->description),
                            'placeholder' => 'Deskripsi',
                            'show' => true,
                            'disabled' => true,
                        ])
                        {{-- @include('components.form.text_area', [
                            'class_group' => 'mb-3',
                            'field_name' => 'lokasi',
                            'label' => 'Lokasi',
                            'value' => old('lokasi', $row->lokasi),
                            'placeholder' => 'Lokasi',
                            'show' => true,
                            'disabled' => true,
                        ]) --}}

                    </div>
                    <div class="col-md-6">
                        <img class="card-img-top" style="height: 450px;" src="{{ url('files').'?_path='.$row->image->path }}"
                        alt="Card image cap" />
                    </div>
                </div>
                <div class="form-group">
                    {{-- <button type="submit" class="btn btn-primary">Simpan</button> --}}
                    <a type="button" class="btn btn-secondary" href="{{ route('web.asrama.index') }}">Kembali</a>
                </div>
            </form>
        </div>
    @endsection
