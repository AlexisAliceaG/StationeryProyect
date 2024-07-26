<?php

namespace App\Http\Livewire\Sales;

use Livewire\Component;
use App\Models\Product;
use App\Models\Sale;
use App\Models\DetailsSale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateSale extends Component
{
    public $products;
    public $quantities = [];
    public $saleDate;
    public $total = 0;

    public function mount()
    {
        $this->products = Product::all();
    }

    public function updatedQuantities()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->quantities as $productId => $quantity) {
            $product = $this->products->find($productId);
            if ($product) {
                $this->total += $product->price * $quantity;
            }
        }
    }

    public function saveSale(): void
    {
        $this->validate([
            'saleDate' => 'required|date',
            'quantities.*' => 'numeric|min:0',
        ]);
    
        // Generar UUID para la venta
        $saleId = Str::uuid();
    
        DB::transaction(function () use ($saleId) {
            // Crear la venta
            $sale = Sale::create([
                'id' => $saleId,
                'date' => $this->saleDate,
                'total' => $this->total,
            ]);
    
            // Crear detalles de la venta
            foreach ($this->quantities as $productId => $quantity) {
                if ($quantity > 0) {
                    $product = Product::find($productId);
                    DetailsSale::create([
                        'id' => Str::uuid(),
                        'quantity' => $quantity,
                        'unit_price' => $product->price,
                        'subtotal' => $product->price * $quantity,
                        'sales_id' => $saleId,
                        'product_id' => $productId,
                    ]);
                }
            }
        });
    
        session()->flash('message', 'Venta registrada con éxito.');
    }

    public function render()
    {
        return view('livewire.sales.create-sale');
    }
}
