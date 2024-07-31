@extends('dashboard')

@section('title', 'Registrar Recibo')

@section('content_header')
    <section class="container content-header card" style="background-color: rgba(245, 245, 245, 0.4); ">
        <div class="container">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Registrar Recibo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Registrar Recibo</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop

@section('views')
    <div class="container p-2 card">
      <div class="row">
        <div class="col-12">
            @livewire('receipts.home', key('home' . time()))
        </div>
      </div>
    </div>
@stop
