<?php

namespace App\Http\Controllers\Receipt;

use App\Http\Controllers\Controller;

class ReceiptController extends Controller
{
    /**
     * [Description for index]
     *
     * @return [type]
     *
     */
    public function index()
    {
        return view('receipt.index');
    }
}
