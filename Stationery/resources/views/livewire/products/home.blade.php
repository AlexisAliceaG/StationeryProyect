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