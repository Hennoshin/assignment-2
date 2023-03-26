@extends('layouts.default')

@section('content')
    @php
        $module = 'Riwayat Absensi';
        $fields = [
            [
                'label' => 'Date',
                'field' => 'date',
            ],
            [
                'label' => 'Employee',
                'field' => 'employee',
            ],
            [
                'label' => 'Status',
                'field' => 'status',
            ],
            [
                'label' => 'Action',
                'field' => 'action',
            ],
        ];
    @endphp
    @include('components.alert.error')
    @if (auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN))
        <div class="card mb-4" style="height: 500px">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Absence</h5>
                        <div>
                            @include('components.qr', [
                                'id' => 'absence_qr_in',
                                'value' => route('web.attendence.quick-add'),
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="card">
        <h5 class="card-header">{{ $module }}</h5>
        <div class="table-responsive text-nowrap px-4 py-2" style="height: 600px;">
        @if (auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN))
            <div class="text-end">
                <a target="_blank" href="{{ route('web.attendence.export') }}" type="button" class="btn btn-icon btn-primary">
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
                                <strong>{{ date('d-m-Y H:i', strtotime($item->absence_date)) }}</strong>
                            </td>
                            <td>{{ $item->employee->name ?? '-' }}</td>
                            <td>{!! $item->status == 1
                                ? '<span class="badge bg-primary">IN</span>'
                                : '<span class="badge bg-warning">OUT</span>' !!}</td>
                            <td>
                                @if (auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN))
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        {{-- <a class="dropdown-item"
                                            href="{{ route('web.attendence.edit', ['id' => $item->uuid]) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a> --}}
                                        <form id="form_delete_{{ $item->uuid }}"
                                            action="{{ route('web.attendence.delete', ['id' => $item->uuid]) }}"
                                            method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                        <a class="dropdown-item" href="javascript:void(0);"
                                            onclick="deleteAction(`{{ $item->uuid }}`, `{{ route('web.attendence.delete', ['id' => $item->uuid]) }}`)"><i
                                                class="bx bx-trash me-1"></i>
                                            Delete</a>
                                    </div>
                                </div>
                                @endif
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
    <div class="buy-now">
        <button type="button" class="btn btn-danger btn-buy-now" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah {{ $module }}
        </button>
    </div>
    {{-- MODAL --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Attendence</h5>
                </div>
                <div class="modal-body">
                    <!-- QR SCANNER CODE BELOW  -->
                    <div class="row">
                        <div class="col-12">
                            <div id="reader"></div>
                        </div>
                        <div class="col-12" style="padding: 30px">
                            <div id="result">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.2.0/html5-qrcode.min.js"></script>
    <script>
        // When scan is successful fucntion will produce data
        function onScanSuccess(qrCodeMessage) {
            window.location.replace(qrCodeMessage);
        }
    
        // When scan is unsuccessful fucntion will produce error message
        function onScanError(errorMessage) {
            // Handle Scan Error
            document.getElementById("result").innerHTML = '<span class="result">' + errorMessage + "</span>";
        }
    
        // Setting up Qr Scanner properties
        var html5QrCodeScanner = new Html5QrcodeScanner("reader", {
            fps: 10,
            qrbox: 250
        });
    
        // in
        html5QrCodeScanner.render(onScanSuccess, onScanError);
    </script>
    {{-- MODAL --}}
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
