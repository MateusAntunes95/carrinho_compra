<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('home.index', compact('products'));
    }

    public function details($id)
    {
        $product = Product::find($id);

        return view('home.details', compact('product'));
    }



}
