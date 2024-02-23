@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('/cms-assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet"
    href="{{ asset('/cms-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet"
    href="{{ asset('/cms-assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
<link rel="stylesheet" href="{{ asset('/cms-assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />

@endsection


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header">Transactions History</h3>
                    <div class="card-body">
                        @include('alert')

                        <div class="mb-3">
                            <label>Total Balance</label>
                            
                            <h3>Rp. {{ number_format($total, 2, ',', '.') }}</h3>
                        </div>

                        <table class="datatables-basic table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection


@section('js')

<script src="{{ asset('/cms-assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script>
    $(function() {
        const table = $('.datatables-basic').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            lengthChange: false,
            pageLength: 5,
            searching: true,
            ajax: '{!! route('transactions') !!}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'currency',
                    name: 'currency'
                },
                {
                    data: 'note',
                    name: 'note'
                }
            ]
        });
        
    });
</script>
@endsection

