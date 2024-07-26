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
    public $productQuantities = [];
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
        $this->quantities[] = [
            'productId' => $this->selectedProduct,
            'quantity' => $this->productQuantities
        ];
        $this->calculateTotal();
        $this->selectedProduct = null;
        $this->productQuantities = 0;
    }

    public function saveSale()
    {
        if (!empty($this->quantities)) {
            $this->validate([
                'quantities' => 'required|min:0',
            ]);

            $saleId = Str::uuid();
            $saleDate = Carbon::now(); // Obtener la fecha y hora actuales

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

            $this->selectedProduct = null;
            $this->productQuantities = 0;
            $this->quantities = [];
            $this->total = 0;
            session()->flash('message', 'Venta registrada con éxito.');
        }
    }

    public function render()
    {
        return view('livewire.sales.create-sale');
    }
}
