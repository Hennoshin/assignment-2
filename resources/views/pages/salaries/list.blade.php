@extends('layouts.default')

@section('content')
    @php
        $module = 'Gaji';
        $fields = [
            [
                'label' => 'Employee',
                'field' => 'employee',
            ],
            [
                'label' => 'Bulan',
                'field' => 'bulan',
            ],
            [
                'label' => 'Income',
                'field' => 'gaji_pokok',
            ],
            [
                'label' => 'Uang Beras',
                'field' => 'uang_beras',
            ],
            [
                'label' => 'Uang Makan',
                'field' => 'uang_makan',
            ],
            [
                'label' => 'Lembur',
                'field' => 'lembur',
            ],
            [
                'label' => 'Tunjangan',
                'field' => 'tunjangan',
            ],
            [
                'label' => 'Hutang / Cicilan',
                'field' => 'hutang',
            ],
            [
                'label' => 'Total',
                'field' => 'total',
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
        <div class="table-responsive text-nowrap px-4 py-2" style="height: 800px;">
            @if (auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN))
                <div class="text-end">
                    <a target="_blank" href="{{ route('web.salaries.export') }}" type="button"
                        class="btn btn-icon btn-primary">
                        <span class="tf-icons bx bxs-file-export"></span>
                    </a>
                    <a target="_blank" href="{{ route('web.salaries.gopageimport') }}" type="button"
                        class="btn btn-icon btn-warning">
                        <span class="tf-icons bx bxs-file-import"></span>
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
                                <strong>{{ $item->employee?->name ?? '-' }}</strong>
                            </td>
                            <td>{{ $item->bulan ? date('M Y', strtotime($item->created_at)) : '-' }}</td>
                            <td>{{ number_format($item->gaji_pokok) }}</td>
                            <td>{{ number_format($item->uang_beras) }}</td>
                            <td>{{ number_format($item->uang_makan) }}</td>
                            <td>{{ number_format($item->lembur) }}</td>
                            <td>{{ number_format($item->tunjangan) }}</td>
                            <td>{{ number_format($item->hutang) }}</td>
                            <td>{{ number_format($item->total_income) }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                            @if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF))
                                <td>
                                    <a target="_blank" href="{{ route('web.salaries.print', ['id' => $item->uuid]) }}" type="button" class="btn btn-icon btn-primary">
                                        <span class="tf-icons bx bx-printer"></span>
                                    </a>
                                </td>
                            @endif
                            @if (auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN))
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('web.salaries.edit', ['id' => $item->uuid]) }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</a>
                                            <form id="form_delete_{{ $item->uuid }}"
                                                action="{{ route('web.salaries.delete', ['id' => $item->uuid]) }}"
                                                method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                            <a class="dropdown-item" href="javascript:void(0);"
                                                onclick="deleteAction(`{{ $item->uuid }}`, `{{ route('web.salaries.delete', ['id' => $item->uuid]) }}`)"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            @endif
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
            <a href="{{ route('web.salaries.create') }}" class="btn btn-danger btn-buy-now">Tambah {{ $module }}</a>
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
