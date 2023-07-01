<?php

namespace App\Http\Controllers;

use App\Models\DiscountDoupon;
use App\Models\Request as ModelsRequest;
use App\Models\RequestProduct;
use Carbon\Carbon;
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

        return response()->json([]);
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
        RequestProduct::where('request_id', $request->request_id)->update(['status' => 'PA']);
        ModelsRequest::where('id', $request->request_id)->update(['status' => 'PA']);

        return redirect()
            ->route('cart.purchase')
            ->with('success', 'Compra realizada com sucesso');
    }

    public function purchase()
    {
        $purchases = ModelsRequest::where('status', 'PA')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $canceleds = ModelsRequest::where('status', 'CA')
            ->where('user_id', auth()->user()->id)
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('cart.purchase', compact('purchases', 'canceleds'));
    }

    public function canceled(Request $request)
    {
        if (empty($request->id)) {
            return redirect()->route('cart.purchase')->with('error', 'Nenhum produto selecionado para cancelar!');
        }

        RequestProduct::where('request_id', $request->request_id)
            ->where('status', 'PA')
            ->whereIn('id', $request->id)->update(['status' => 'CA']);

        $checkRequestCancel = RequestProduct::where('request_id', $request->request_id)
            ->where('status', 'PA')->exists();

        if (!$checkRequestCancel) {
            ModelsRequest::where('id', $request->request_id)
                ->update(['status' => 'CA']);

            return redirect()->route('cart.purchase')->with('success', 'Pedido cancelado com sucesso!');
        }

        return redirect()->route('cart.purchase')->with('success', "item(ns) cancelado com sucesso!");
    }

    public function discount(Request $request)
    {
        $doupon = DiscountDoupon::where('locator', $request->doupon)->where('active', 1)->first();
        if (empty($doupon)) {
            return redirect()->route('cart.index')->with('error', 'Cupom não registrado');
        }

        $expirationDate = Carbon::parse($doupon->expiration_date);

        if ($expirationDate->isPast()) {

            return redirect()->route('cart.index')->with('error', 'O cupom expirou');
        }

        $requestProduct = RequestProduct::where([
            'request_id' => $request->request_id,
            'status' => 'RE',
        ])->get();

        $discount = false;

        foreach ($requestProduct as $rp) {
            $discountValue = $doupon->discount;

            if ($discountValue > $rp->value ) {

                $discountValue = $rp->value;
            }

            $valueMaxDiscount = RequestProduct::whereIn('status', ['PA', 'RE'])->where(
                [
                    'discount_doupon_id' => $doupon->id
                ])->sum('discount');

            if (($valueMaxDiscount + $discountValue) >= $doupon->discount) {
                $discount = false;
                continue;
            }

            $rp->discount_doupon_id = $doupon->id;
            $rp->discount = $discountValue;
            $rp->update();
            $discount = true;

        }

        if ($discount) {
            return redirect()->route('cart.index')->with('success', 'Cupom aplicado com sucesso');
        }

        return redirect()->route('cart.index')->with('error', 'Cupom esgotado');
    }
}
