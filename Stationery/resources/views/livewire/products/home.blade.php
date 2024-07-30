<div>
    @livewire('products.modal', key('modal-'))
    @livewire(
        'products.card',
        [
            'model' => $model,
            'methods' => $methods,
        ],
        key('table' . time())
    )
</div>
@section('plugins.Sweetalert2', true)

@section('js')
  <script src="{{ asset('vendor/custom/js/toast.js') }}"></script>
@stop
