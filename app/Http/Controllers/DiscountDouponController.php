<?php

namespace App\Http\Controllers;

use App\Models\DiscountDoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountDouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::check() && !Auth::user()->admin) {
                return redirect()->route('home')->with('error', 'Acesso não autorizado');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $doupon = DiscountDoupon::query();

        if (!empty($request->name)) {
            $doupon->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if (!empty($request->id)) {
            $doupon->where('id', $request->id);
        }

        $dados = $doupon->get();

       return view('discount_doupon.index', compact('request', 'dados'));
    }

    public function create()
    {
        $doupon = new DiscountDoupon();

        return view('discount_doupon.create', compact('doupon'));
    }

    public function store(Request $request)
    {
        $doupon = new DiscountDoupon();
        $doupon->fill($request->all());
        $doupon->active =  $request->has('active');
        $doupon->saveOrFail();

        return redirect()->route('desconto.index')->with('success', 'Cupom criado com sucesso!');
    }

    public function edit(string $id)
    {
        $doupon = DiscountDoupon::find($id);

        return view('discount_doupon.edit', compact('doupon'));
    }

    public function update(Request $request, string $id)
    {
        $doupon = DiscountDoupon::find($id);
        $doupon->fill($request->all());
        $doupon->active =  $request->has('active');
        $doupon->saveOrFail();

        return redirect()->route('desconto.index')->with('success', 'Cupom editado com sucesso!');
    }

    public function destroy(string $id)
    {
        //
    }
}
