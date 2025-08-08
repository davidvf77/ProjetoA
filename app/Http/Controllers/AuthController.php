<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function logout()
    {
        Auth::logout();
        return redirect('/entrar');
    }

    public function register(Request $request)
    {
        try {
            $dados = $request->validate([
                'username' => 'required|unique:users',
                'password' => 'required|confirmed'
            ]);

            $dados['password'] = Hash::make($dados['password']);

            $user = User::create($dados);

            auth()->guard('web')->login($user);
            return redirect('/metas');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();

            if ($errors->has('username')) {
                $errorMessage = 'Erro no registro: nome de usuário já existe';
            } elseif ($errors->has('password')) {
                $errorMessage = 'Erro no registro: senha é obrigatória e deve ser confirmada';
            } elseif ($errors->has('password_confirmation')) {
                $errorMessage = 'Erro no registro: a confirmação de senha não confere';
            } else {
                $errorMessage = 'Erro no registro: dados inválidos';
            }

            return redirect('/entrar')
                ->with('error', $errorMessage)
                ->with('form', 'register');
        } catch (QueryException $e) {
            return redirect('/entrar')
                ->with('error', 'Erro ao registrar. Tente novamente.')
                ->with('form', 'register');
        }
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect('/entrar')
                ->with('error', 'Credenciais Inválidas')
                ->with('form', 'login');
        }

        auth()->guard('web')->login($user);

        if ($user->metas()->exists()) {
            return redirect('/metas/dashboard');
        }

        return redirect('/metas');
    }
}
