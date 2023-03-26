@extends('layouts.default')

@section('content')
    @php
        $module = 'Lemburan';
        $fields = [
            [
                'label' => 'Employee',
            ],
            [
                'label' => 'Start Date',
            ],
            [
                'label' => 'End Date',
            ],
            [
                'label' => 'Progress',
            ],
            [
                'label' => 'Approve By',
            ],
            [
                'label' => 'Status',
            ],
            [
                'label' => 'Approve Notes',
            ],
            [
                'label' => 'Created At',
                'field' => 'created_at',
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
                    <a target="_blank" href="{{ route('web.overtime.export') }}" type="button"
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
                                <strong>{{ $item->employee->name ?? '-' }}</strong>
                            </td>
                            <td>{{ date('d-m-Y', strtotime($item->start_date)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->end_date)) }}</td>
                            <td>{{ $item->progress ?? '-' }}</td>
                            <td>{{ $item->approveBy->name ?? '-' }}</td>
                            <td>
                                @if ($item->approve_status == 0)
                                    Waiting Approval
                                @else
                                    {{ $item->approve_status == 2 ? 'Rejected' : 'APPROVE' }}
                                @endif
                            </td>
                            <td>{{ $item->approve_notes ?? '-' }}</td>
                            <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('web.overtime.show', ['id' => $item->uuid]) }}"><i
                                                class="bx bx-show me-1"></i>
                                            Detail</a>
                                        <form id="form_delete_{{ $item->uuid }}"
                                            action="{{ route('web.overtime.delete', ['id' => $item->uuid]) }}"
                                            method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                        @if (
                                            $item->approve_status == 0 &&
                                                auth()->user()->hasRole(\App\Constants\RoleConst::STAFF))
                                            <a class="dropdown-item" href="javascript:void(0);"
                                                onclick="deleteAction(`{{ $item->uuid }}`, `{{ route('web.overtime.delete', ['id' => $item->uuid]) }}`)"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</a>
                                        @endif
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
            {{ $list->links("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>
    @if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF))
        <div class="buy-now">
            <a href="{{ route('web.overtime.create') }}" class="btn btn-danger btn-buy-now">Tambah
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
