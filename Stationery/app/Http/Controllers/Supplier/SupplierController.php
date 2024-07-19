<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * [Description for index]
     *
     * @return [type]
     *
     */
    public function index()
    {
        return view('supplier.index');
    }
}
