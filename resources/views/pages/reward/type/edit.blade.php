@extends('layouts.default')

@section('content')
    @php
        $module = "Tipe Reward"
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Ubah {{$row->title}}
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.reward-type.update', ["id" => $row->uuid]) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'title',
                            'label' => 'Title',
                            'value' => old('title', $row->title),
                            'placeholder' => 'Title',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'is_enabled',
                            'label' => 'is_enabled',
                            'value' => old('is_enabled', $row->is_enabled),
                            'placeholder' => 'is_enabled',
                            'show' => true,
                            'options' => [
                                ['label' => 'Active', 'value' => 1],
                                ['label' => 'Inactive', 'value' => 0],
                            ],
                            'key_option_value' => 'value',
                            'key_option_label' => 'label',
                            'required' => true,
                            'disable' => false,
                            'accept' => null,
                        ])
                    </div>
                    <div class="col-md-6">
                        @include('components.form.text_area', [
                            'class_group' => 'mb-3',
                            'field_name' => 'description',
                            'label' => 'Description',
                            'value' => old('description', $row->description),
                            'placeholder' => 'Description',
                            'show' => true,
                            'disable' => false,
                        ])
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.reward-type.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    @endsection
