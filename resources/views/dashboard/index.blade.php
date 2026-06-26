@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content')
    <style>
        .item-dashboard {
            border: none;
            border-radius: 10px;
            border: .5px solid #a2a2a2;
            padding: 20px;
            margin: 20px;
        }
    </style>
    <div class="container">
        <div class="row">
            <img src="{{ asset('assets/images/under development.png') }}" alt="Dashboard" class="img-fluid mx-auto d-block"
                style="max-width: 50%;">
        </div>
    </div>
@endsection
