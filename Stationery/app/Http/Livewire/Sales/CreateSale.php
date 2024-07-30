<?php

namespace App\Http\Livewire\Sales;

use Livewire\Component;
use App\Models\Product;
use App\Models\Sale;
use App\Models\DetailsSale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CreateSale extends Component
{
    public $products;
    public $selectedProduct = null;
    public $productQuantities = null;
    public $quantities = [];
    public $total = 0;

    public function mount()
    {
        $this->products = Product::all();
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->quantities as $item) {
            $productId = $item['productId'];
            $quantity = $item['quantity'];
            $product = $this->products->find($productId);
            if ($product) {
                $this->total += $product->price * $quantity;
            }
        }
    }

    public function addProduct()
    {
        $this->validate([
            'selectedProduct' => 'required|exists:products,id',
            'productQuantities' => 'required|numeric|min:1',
        ]);

        $this->quantities[] = [
            'productId' => $this->selectedProduct,
            'quantity' => $this->productQuantities
        ];
        $this->calculateTotal();
        $this->selectedProduct = null;
        $this->productQuantities = null;
    }

    public function saveSale()
    {
        if (!empty($this->quantities)) {
            $this->validate([
                'quantities' => 'required|min:0',
            ]);

            $saleId = Str::uuid();
            $saleDate = Carbon::now();

            DB::transaction(function () use ($saleId, $saleDate) {
                $sale = Sale::create([
                    'id' => $saleId,
                    'date' => $saleDate,
                    'total' => $this->total,
                ]);

                foreach ($this->quantities as $item) {
                    $productId = $item['productId'];
                    $quantity = $item['quantity'];
                    $product = Product::find($productId);
                    if ($product) {
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
            $this->dispatch('confirmSuccess');            
            $this->selectedProduct = null;
            $this->productQuantities = null;
            $this->quantities = [];
            $this->total = 0;
        }
    }
    public function cancel()
    {
        $this->selectedProduct = null;
        $this->productQuantities = null;
        $this->quantities = [];
        $this->total = 0;
        $this->dispatch('CancelSale');            
    }

    public function render()
    {
        return view('livewire.sales.create-sale');
    }
}
