@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-xl">
                @component('components.alert.success')
                @endcomponent
                @component('components.alert.error')
                @endcomponent
                {{-- start --}}
                <div class="card mb-4">
                    <h5 class="card-header">My Profile</h5>
                    <!-- Account -->

                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @if (isset($row->avatar()->first('path')->path))
                                <img src="{{ route('web.getfiles') }}?_path={{ $row->avatar()->first('path')->path }}" alt="user-avatar"
                                    class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            @else
                                <img src="{{ asset('images/avatar-empty.png') }}" alt="user-avatar" class="d-block rounded"
                                    height="100" width="100" id="uploadedAvatar" />
                            @endif
                            <form autocomplete="off" action="{{ url('user/change-avatar') }}" method="POST"
                                enctype="multipart/form-data" id="form-upload-avatar">
                                @csrf
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" name="avatar" id="upload" class="account-file-input"
                                            hidden="" accept="image/png, image/jpeg">
                                    </label>

                                    <p class="text-muted mb-0">Allowed JPG, or PNG. Max size of 800K</p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                @include('components.form.input', [
                                    'class_group' => 'mb-3',
                                    'field_name' => 'name',
                                    'label' => 'Fullname',
                                    'value' => old('name', $row->name),
                                    'placeholder' => 'Fullname',
                                    'show' => true,
                                    'disabled' => true,
                                ])

                                @include('components.form.input', [
                                    'class_group' => 'mb-3',
                                    'field_name' => 'email',
                                    'label' => 'Email',
                                    'value' => old('email', $row->email),
                                    'placeholder' => 'email',
                                    'type' => 'email',
                                    'show' => true,
                                    'disabled' => true,
                                ])

                                @include('components.form.input', [
                                    'class_group' => 'mb-3',
                                    'field_name' => 'status',
                                    'label' => 'Status',
                                    'value' => old('status', $row->is_enabled ? 'Active' : 'Deactive'),
                                    'placeholder' => 'status',
                                    'show' => true,
                                    'disabled' => true,
                                ])

                                @include('components.form.input', [
                                    'class_group' => 'mb-3',
                                    'field_name' => 'name',
                                    'label' => 'Roles',
                                    'value' => old('roles', $row->roles[0]->name),
                                    'placeholder' => 'Fullname',
                                    'show' => true,
                                    'disabled' => true,
                                ])

                            </div>
                            
                        </div>
                    </div>
                    <!-- /Account -->
                    <div class="card-footer">
                        <form id="logout-form-do-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <div onclick="event.preventDefault(); document.getElementById('logout-form-do-logout').submit();"
                            class="btn btn-danger">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle" href="{{ route('logout') }}">
                                Logout
                            </span>
                        </div>
                        <a href="#" class="btn btn-primary">Edit</a>
                    </div>
                </div>

                <div class="card">
                    <h5 class="card-header">Change Password</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">You Can Change Password</h6>
                                <p class="mb-0">For Change Information Profile, Please Call Administrations</p>
                            </div>
                        </div>
                        <form action="{{ url('/user/change-password') }}" method="POST" class="mb-3">
                            @csrf
                            @include('components.form.password', [
                                'class_group' => 'mb-3',
                                'field_name' => 'old_password',
                                'label' => 'Old Password',
                                'value' => old('old_password'),
                                'placeholder' => 'Old password',
                                'show' => true,
                                'disabled' => false,
                            ])
                            @include('components.form.password', [
                                'class_group' => 'mb-3',
                                'field_name' => 'password',
                                'label' => 'New Password',
                                'value' => old('password'),
                                'placeholder' => 'password',
                                'show' => true,
                                'disabled' => false,
                            ])

                            @include('components.form.password', [
                                'class_group' => 'mb-3',
                                'field_name' => 'password_confirmation',
                                'label' => 'Password Confirmation',
                                'value' => old('password_confirmation'),
                                'placeholder' => 'password Confirmation',
                                'show' => true,
                                'disabled' => false,
                            ])
                            <button type="submit" class="btn app-btn btn-primary">
                                <div class="px-5">Save</div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- start --}}
        </div>
        </div>
    @endsection

@section('script')
    @parent
    <script>
        $('#upload').on('change', function() {
            $("#form-upload-avatar").submit();
        });
    </script>
@endsection
