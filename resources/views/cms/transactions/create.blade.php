@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('/cms-assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('/cms-assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
@endsection


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header">Transaction Create</h3>
                    <div class="card-body">
                        @include('alert')
                        <div class="mb-3">
                            <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select id="selectpickerLiveSearch" class="selectpicker form-select"
                                        data-style="btn-default" data-live-search="true" name="type">
                                        <option value="topup" {{ old('type') == 'topup' ? 'selected' : '' }}>Top Up
                                        </option>
                                        <option value="transaction" {{ old('type') == 'transaction' ? 'selected' : '' }}>
                                            Transaction</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>

                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount" required
                                        value="{{ old('amount') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="note" class="form-label">Notes</label>
                                    <textarea class="form-control" id="note" name="note" rows="3"> 
                                         {{ old('note') }}    
                                    </textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('js')
    <script src="{{ asset('/cms-assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('/cms-assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.selectpicker').selectpicker();

            $('.selectpicker').on('change', function() {
                $("#image").val('');
                var val = this.value;
                if (val == 'topup') {
                    $("#image").removeAttr("disabled");
                    $("#image").attr("required", true);
                } else {
                    $("#image").attr('disabled', 'disabled');
                    $("#image").attr("required", false);
                }

            });

        });
    </script>
@endsection
