@extends('layouts.default')

@section('content')
    @php
        $module = "Paket Makanan Karyawan"
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Ubah {{$row->code}} - {{$row->title}}
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.rewards.update', ["id" => $row->uuid]) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">
                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'code',
                            'label' => 'Code',
                            'value' => old('code', $row->code),
                            'placeholder' => 'Code',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'title',
                            'label' => 'Title',
                            'value' => old('title', $row->title),
                            'placeholder' => 'Title',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'reward_type_id',
                            'label' => 'Tipe Reward',
                            'value' => old('reward_type_id', $row->type->uuid),
                            'placeholder' => 'Tipe Reward',
                            'show' => true,
                            'options' => \App\Models\RewardType::where('is_enabled', 1)->get(),
                            'key_option_value' => 'uuid',
                            'key_option_label' => 'title',
                            'required' => true,
                            'disable' => false,
                            'accept' => null,
                        ])

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
                    <div class="col-md-6">
                        @include('components.form.number', [
                            'class_group' => 'mb-3',
                            'field_name' => 'point',
                            'label' => 'Point',
                            'value' => old('point', $row->point),
                            'placeholder' => 'Point',
                            'min' => 0,
                            'max' => 999999999999,
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'unit',
                            'label' => 'Unit',
                            'value' => old('unit', $row->unit),
                            'placeholder' => 'Unit',
                            'show' => true,
                            'disable' => false,
                        ])
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.rewards.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    @endsection
