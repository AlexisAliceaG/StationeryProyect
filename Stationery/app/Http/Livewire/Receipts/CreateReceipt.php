<?php

namespace App\Http\Livewire\Receipts;

use Livewire\Component;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Receipt;
use App\Models\DetailsReceipt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CreateReceipt extends Component
{
    public $products;
    public $suppliers;
    public $selectedProduct = null;
    public $selectedSupplier = null;

    public $productQuantities = null;
    public $quantities = [];
    public $total = 0;

    public function mount()
    {
        $this->products = Product::all();
        $this->suppliers = Supplier::all();
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
            'selectedSupplier' => 'required|min:1',
        ]);
        $this->quantities[] = [
            'productId' => $this->selectedProduct,
            'quantity' => $this->productQuantities
        ];
        $this->calculateTotal();
        $this->selectedProduct = null;
        $this->productQuantities = null;
    }

    public function saveReceipt()
    {
        if (!empty($this->quantities)) {
            $this->validate([
                'quantities' => 'required|min:0',
                'selectedSupplier' => 'required|min:1',
            ]);

            $receiptId = Str::uuid();
            $receipDate = Carbon::now();

            DB::transaction(function () use ($receiptId, $receipDate) {
                $receipt = Receipt::create([
                    'id' => $receiptId,
                    'date' => $receipDate,
                    'total' => $this->total,
                    'supplier_id' => $this->selectedSupplier,
                ]);

                foreach ($this->quantities as $item) {
                    $productId = $item['productId'];
                    $quantity = $item['quantity'];
                    $product = Product::find($productId);
                    if ($product) {
                        $product->update([
                            'stock_quantity' => $product->stock_quantity + $quantity
                        ]);
                        DetailsReceipt::create([
                            'id' => Str::uuid(),
                            'quantity' => $quantity,
                            'unit_price' => $product->price,
                            'subtotal' => $product->price * $quantity,
                            'receipt_id' => $receiptId,
                            'product_id' => $productId,
                        ]);
                    }
                }
            });
            $this->dispatch('confirmSuccess');
            $this->selectedSupplier = null;
            $this->selectedProduct = null;
            $this->productQuantities = null;
            $this->quantities = [];
            $this->total = 0;
        } else {
            $this->dispatch('EmpetyOptions');
        }
    }
    public function cancel()
    {
        $this->selectedProduct = null;
        $this->selectedSupplier = null;
        $this->productQuantities = null;
        $this->quantities = [];
        $this->total = 0;
        $this->dispatch('CancelReceipt');
    }
    public function render()
    {
        return view('livewire.receipts.create-receipt');
    }
}
