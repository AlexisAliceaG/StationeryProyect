<div>
    @livewire('sales.create-sale', key('modal'))
</div>
@section('plugins.Sweetalert2', true)

@section('js')
  <script src="{{ asset('vendor/custom/js/toast.js') }}"></script>
@stop
