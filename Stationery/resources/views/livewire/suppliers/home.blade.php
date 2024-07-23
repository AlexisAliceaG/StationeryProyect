<div>
    @livewire('suppliers.modal', key('modal-' . $selectedSupplierId))

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