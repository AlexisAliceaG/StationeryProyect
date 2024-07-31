<?php

namespace App\Http\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductsForm extends Form
{
    public ?Product $product;

    public $id = '';

    #[Validate('required|max:100', translate: true)]
    public $name = '';

    #[Validate('nullable|max:2048', translate: true)]
    public $image_url = '';

    #[Validate('required|max:100', translate: true)]
    public $description = '';

    #[Validate('required|numeric', translate: true)]
    public $price = '';

    #[Validate('required|numeric', translate: true)]
    public $stock_quantity = '';

    #[Validate('required|max:250', translate: true)]
    public $categorie_id = '';

    #[Validate('required|max:250', translate: true)]
    public $state_id = '';

    #[Validate('required|max:250', translate: true)]
    public $supplier_id = '';

    public function setProduct(Product $product): void
    {
        $this->product = $product;
        $this->id = $product->id;
        $this->image_url = $product->image_url;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock_quantity = $product->stock_quantity;
        $this->categorie_id = $product->categorie_id;
        $this->state_id = $product->state_id;
        $this->supplier_id = $product->supplier_id;
    }

    public function save()
    {
        $this->validate();
        if (!is_null($this->product->id)) {
            $this->product->update([
                'image_url' => $this->image_url,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'stock_quantity' => $this->stock_quantity,
                'categorie_id' => $this->categorie_id,
                'state_id' => $this->state_id,
                'supplier_id' => $this->supplier_id,
            ]);
        } else {
            Product::create([
                'id' => Str::uuid(),
                'image_url' => $this->image_url,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'stock_quantity' => $this->stock_quantity,
                'categorie_id' => $this->categorie_id,
                'state_id' => $this->state_id,
                'supplier_id' => $this->supplier_id,
            ]);
        }
        $this->cancel();
    }

    public function reset(...$properties)
    {
        if (empty($properties)) {
            $this->id = '';
            $this->image_url = '';
            $this->name = '';
            $this->description = '';
            $this->price = '';
            $this->stock_quantity = '';
            $this->categorie_id = '';
            $this->state_id = '';
            $this->supplier_id = '';
            $this->product = new Product();
        } else {
            foreach ($properties as $property) {
                $this->{$property} = null;
            }
        }
    }

    public function cancel()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
