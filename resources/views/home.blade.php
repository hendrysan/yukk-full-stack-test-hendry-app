@extends('layouts.admin')

@section('css')
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header">Dashboard</h3>
                    <div class="card-body">
                        @include('alert')
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection


@section('js')
@endsection
