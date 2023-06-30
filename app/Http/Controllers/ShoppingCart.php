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
        $requestId = ModelsRequest::where('user_id', $user_id)
            ->where('status', 'RE')
            ->first();

        if (empty($requestId)) {
            info('não era p entrar aq');
            $newRequest = new ModelsRequest();
            $newRequest->user_id = $user_id;
            $newRequest->status = 'RE';
            $newRequest->save();
        }

        $requestProduct = new RequestProduct();
        $requestProduct->request_id = $requestId->id ?? $newRequest->id;
        $requestProduct->product_id = $request['product_id'];
        $requestProduct->value = $request['product_value'];
        $requestProduct->status = 'RE';
        $requestProduct->save();

        return response()->json(['message' => 'Requisição AJAX recebida com sucesso']);
    }

    public function destroy(Request $request)
    {
        $requestProduct = RequestProduct::where('request_id', $request['request_id'])
            ->where('product_id', $request['product_id'])
            ->orderBy('id', 'desc')
            ->first();

        $requestProduct->delete();

        $checkRequest = RequestProduct::where('request_id', $request['request_id'])->exists();

        if (!$checkRequest) {
            ModelsRequest::where('id', $request['request_id'])->delete();
        }

        return response()->json(['Produto removido do carrinho com sucesso']);
    }

    public function conclude(Request $request)
    {
        RequestProduct::where('request_id', $request->request_id)
            ->update(['status' => 'PA']);
        ModelsRequest::where('id', $request->request_id)
            ->update(['status' => 'PA']);

        return redirect()->route('cart.purchase')->with('success', 'Compra realizada com sucesso');
    }

    public function purchase()
    {
       $purchases = ModelsRequest::where('status', 'PA')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')->get();

        $canceleds = ModelsRequest::where('status', 'CsA')
        ->where('user_id', auth()->user()->id)
        ->orderBy('updated_at', 'desc')->get();

        return view('cart.purchase', compact('purchases', 'canceleds'));
    }
}
