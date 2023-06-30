<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Product\ListarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::check() && !Auth::user()->admin) {
                return redirect()->route('home')->withErrors('Acesso não autorizado');
            }
            return $next($request);
        });
    }
    public function index(Request $request, ListarRepository $listarRepository)
    {
        $dados = $listarRepository->listar($request->all())->paginate(10);

        return view('product.index', compact('request', 'dados'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->fill($request->all());
        if ($request->hasFile('anexo')) {
            $regex = '/\.[\/.]+$/';
            $anexo = $request->anexo;
            $fileName = preg_replace($regex, '', $anexo->getClientOriginalName());
            $extension = $anexo->extension();
            $nameAnexo = $fileName . "_" . uniqid() . "." . $extension;
            $anexo->move(public_path('images/product/'), $nameAnexo);
            $product->image = $nameAnexo;
        }

        $product->saveOrFail();

        return redirect()->route('produto.index')->with('success', 'Produto criado com sucesso');
    }

    public function edit(string $id)
    {
        $product = Product::find($id);

        return view('product.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
