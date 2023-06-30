<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class ShoppingCart extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $requests = ModelsRequest::where([
            'status' => 'RE',
            'user_id' => auth()->user()->id
        ])->get();

        return view('cart.index', compact('requests'));
    }

    public function store()
    {
    }
}
