@extends('layouts.default')

@section('content')
    @php
        $module = 'Paket Makanan Karyawan';
        $fields = [
            [
                'label' => 'Code',
                'field' => 'code',
            ],
            [
                'label' => 'Title',
                'field' => 'title',
            ],
            [
                'label' => 'Type',
                'field' => 'type',
            ],
            [
                'label' => 'Point',
                'field' => 'point',
            ],
            [
                'label' => 'Unit',
                'field' => 'unit',
            ],
            [
                'label' => 'Created At',
                'field' => 'created_at',
            ],
            [
                'label' => 'QR',
                'field' => 'qr',
            ],
            [
                'label' => 'Action',
                'field' => 'action',
            ],
        ];
    @endphp
    @include('components.alert.error')
    <div class="card">
        <h5 class="card-header">{{ $module }}</h5>
        <div class="table-responsive text-nowrap px-4 py-2" style="height: 600px;">
            @if (auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN))
            <div class="text-end">
                <a target="_blank" href="{{ route('web.rewards.export') }}" type="button" class="btn btn-icon btn-primary">
                <span class="tf-icons bx bxs-file-export"></span>
                </a>
            </div>
        @endif
            <table class="table">
                <thead>
                    <tr>
                        @foreach ($fields as $item)
                            @if (auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN) && $item['field'] != 'qr')
                                <th>{{ $item['label'] }}</th>
                            @endif
                            @if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF))
                                <th {{$item['field'] == 'qr' ? 'width="20%"' : '' }}>{{ $item['label'] }}</th>
                            @endif
                        @endforeach
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($list as $item)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $item->code ?? '-' }}</strong>
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->type->title }}</td>
                            <td>{{ $item->point }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                            @if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF))
                                <td>@include('components.qr', [
                                    'id' => $item->id,
                                    'value' => route('web.rewards.claim', [
                                        'id' => $item->uuid,
                                    ]),
                                ])</td>
                            @endif
                            @if (auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN))
                            <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('web.rewards.edit', ['id' => $item->uuid]) }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</a>
                                            <form id="form_delete_{{ $item->uuid }}"
                                                action="{{ route('web.rewards.delete', ['id' => $item->uuid]) }}"
                                                method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                            <a class="dropdown-item" href="javascript:void(0);"
                                                onclick="deleteAction(`{{ $item->uuid }}`, `{{ route('web.rewards.delete', ['id' => $item->uuid]) }}`)"><i
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
            {{ $list->links("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>
    @if (auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN))
        <div class="buy-now">
            <a href="{{ route('web.rewards.create') }}" class="btn btn-danger btn-buy-now">Tambah {{ $module }}</a>
        </div>
    @endif
    @if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF))
        <div class="buy-now">
            <button type="button" class="btn btn-danger btn-buy-now" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Claim {{ $module }}
            </button>
        </div>
        {{-- MODAL --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Claim Reward</h5>
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
