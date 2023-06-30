<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use App\Models\RequestProduct;
use Illuminate\Http\Request;

class ShoppingCart extends Controller
{
    public function index()
    {
        $requests = ModelsRequest::where([
            'status' => 'RE',
            'user_id' => auth()->user()->id,
        ])->get();

        return view('cart.index', compact('requests'));
    }

    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $request_id = ModelsRequest::where('user_id', $user_id)
            ->where('status', 'RE')
            ->first('id');

        if (empty($request_id)) {
            $newRequest = new ModelsRequest();
            $newRequest->user_id = $user_id;
            $newRequest->status = 'RE';
            $newRequest->save();
        }

        $requestProduct = new RequestProduct();
        $requestProduct->request_id = $request_id->id ?? $newRequest->id;
        $requestProduct->product_id = $request['product_id'];
        $requestProduct->value = $request['product_value'];
        $requestProduct->status = 'RE';
        $requestProduct->save();

        return response()->json(['message' => 'Requisição AJAX recebida com sucesso']);
    }
}
