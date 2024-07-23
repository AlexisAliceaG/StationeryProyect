@extends('dashboard')

@section('title', 'Categories')

@section('content_header')
    <section class=" container content-header card" style="background-color: rgba(245, 245, 245, 0.4); ">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Categories</li>
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
            @livewire('categories.home', key('home' . time()))
        </div>
      </div>
    </div>
@stop
