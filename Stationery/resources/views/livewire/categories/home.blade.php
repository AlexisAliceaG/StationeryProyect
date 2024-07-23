<div>
    @livewire('categories.modal', key('modal-' . $selectedCategorieId))

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