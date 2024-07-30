<div>
    @livewire('states.modal', key('modal-' . $selectedStateId))

    @livewire(
        'components.table',
        [
            'headers' => $headers,
            'model' => $model,
            'pagination' => $pagination,
            'direction' => $direction,
            'sortBy' => $sortBy,
            'methods' => $methods,
        ],
        key('table' . time())
    )
</div>

@section('plugins.Sweetalert2', true)

@section('js')
  <script src="{{ asset('vendor/custom/js/toast.js') }}"></script>
@stop
