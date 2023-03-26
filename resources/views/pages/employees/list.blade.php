@extends('layouts.default')

@section('content')
    @php
        $module = 'Pegawai';
        $fields = [
            [
                'label' => 'Nip',
                'field' => 'nip',
            ],
            [
                'label' => 'Unit Kerja',
                'field' => 'unit_kerja',
            ],
            [
                'label' => 'Name',
                'field' => 'name',
            ],
            [
                'label' => 'Gender',
                'field' => 'gender',
            ],
            [
                'label' => 'Phone',
                'field' => 'phone',
            ],
            [
                'label' => 'Tempat',
                'field' => 'tempat',
            ],
            [
                'label' => 'DOB',
                'field' => 'dob',
            ],
            [
                'label' => 'Action',
                'field' => 'action',
            ],
        ];
    @endphp
    <div class="card">
        <h5 class="card-header">{{ $module }}</h5>
        <div class="table-responsive text-nowrap px-4 py-2" style="height: 600px;">
            @if (auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN))
                <div class="text-end">
                    <a target="_blank" href="{{ route('web.employees.export') }}" type="button"
                        class="btn btn-icon btn-primary">
                        <span class="tf-icons bx bxs-file-export"></span>
                    </a>
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        @foreach ($fields as $item)
                            <th>{{ $item['label'] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($list as $item)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $item->nip ?? '-' }}</strong>
                            </td>
                            <td>{{ $item->unitKerja->title ?? '-' }}</td>
                            <td>{{ $item->name ?? '-' }}</td>
                            <td>{{ $item->gender ?? '-' }}</td>
                            <td>{{ $item->phone ?? '-' }}</td>
                            <td>{{ $item->tempat ?? '-' }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->dob)) }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('web.employees.edit', ['id' => $item->uuid]) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form id="form_delete_{{ $item->uuid }}"
                                            action="{{ route('web.employees.delete', ['id' => $item->uuid]) }}"
                                            method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                        <a class="dropdown-item" href="javascript:void(0);"
                                            onclick="deleteAction(`{{ $item->uuid }}`, `{{ route('web.employees.delete', ['id' => $item->uuid]) }}`)"><i
                                                class="bx bx-trash me-1"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($fields) }}" class="text-center">
                                <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Not Found
                                    Data {{ $module }}</strong>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="my-2">
                {{ $list->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    @if (auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN))
        <div class="buy-now">
            <a href="{{ route('web.employees.create') }}" class="btn btn-danger btn-buy-now">Tambah
                {{ $module }}</a>
        </div>
    @endif
@endsection
@section('script')
    <script>
        function deleteAction(id, url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Data has been deleted.',
                        'success'
                    )
                    setTimeout(() => {
                        $('#form_delete_' + id).submit();
                    }, 1000);
                }
            })
        }
    </script>
@endsection
