@extends('dashboard')

@section('title', 'Products')

@section('content_header')
    <section class=" container content-header card" style="background-color: rgba(245, 245, 245, 0.4); ">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop

@section('views')
    <div class="container card p-2">
      <div class="row">
        <div class="col-12">
            @livewire('products.home', key('home' . time()))
        </div>
      </div>
    </div>
@stop
