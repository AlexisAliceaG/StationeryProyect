@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    @yield('views')
    @yield('modal')
@stop

@section('footer')
<footer class="main-footer">
    <div class="row">
        <div class="col-3 text-left">
            <a href="">Terminos y condiciones</a>
        </div>
        <div class="col-6 text-center">

            <a href=""></a><b>Stationery</b></a>
        </div>
        <div class="col-3 float-right text-right">
            <a href="">Aviso de privacidad</a>
        </div>
    </div>
</footer>
@stop