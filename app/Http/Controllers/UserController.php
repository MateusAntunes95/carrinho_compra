<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\User\ListarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request, ListarRepository $listarRepository)
    {

        if (Auth::check() && Auth::user()->admin) {
            $dados = $listarRepository->listar($request->all())->paginate(10);
            return view('user.index', compact('request', 'dados'));
        }

        return redirect()->route('home')->with('error', 'Você não tem permissão para entrar');
    }

    public function create()
    {
        $user = new User();

        return view('user.create', compact('user'));
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->saveOrFail();

        return redirect()->route('home')->with('success', 'Usuário criado com sucesso');
    }

    public function edit(string $id)
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->fill($request->all());
        $user->saveOrFail();
    }

    public function destroy(string $id)
    {
        //
    }
}
