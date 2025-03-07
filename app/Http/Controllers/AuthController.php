<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Função que exibe o form para se registrar
     */
    public function showFormRegister() {
        return view('auth/register');
    }

    /**
     * Função que realiza a inserção de dados no BD do registro do usuário
     */
    public function register(Request $request) {
        
        // Tentar validar os dados, se não conseguir, ir pro catch
        try {
            // Validação dos Dados
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:6'
            ]);

            // Criação do Usuário
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password) // Criptografando a senha
            ]);

            // Redirecionando o usuário após o registro para a tela inicial
            return redirect('/');
        }

        // Tratar apenas erros de validação
        catch (\Illuminate\Validation\ValidationException $e) {
            // Retorna o usuário à página de registrar indicando os erros de validação
            return back()->withErrors($e->errors())->withInput();   
        }

    }

    /**
     * Função que retorna o form de Login
     */
    public function showFormLogin() {
        return view('auth/login');
    }

    /**
     * Função que realiza a autenticação e loga o usuário se as informações inseridas forem corretas
     */
    public function login(Request $request) {

        // Tentar validar os dados, se não conseguir, ir pro catch
        try {

            // Validação dos Dados
            $credentials = $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6'
            ]);

            if (Auth::attempt($credentials)) {
                // Se o login for bem sucedido, redireciona o usuário para a página inicial
                $request->session()->regenerate();
                return redirect('/');
            }

            // Se falhar, redireciona de volto com erro
            return back()->withErrors([
                'email' => 'E-mail ou senha inválidos'
            ])->onlyInput('email');

        }

        // Tratar apenas erros de autenticação
        catch (\Illuminate\Validation\ValidationException $e) {
            // Retorna o usuário à página de login indicando os erros de autenticação
            return back()->withErrors($e->errors())->withInput();   
        }
        
    }

    /**
     * Função de logout do usuário
     */
    public function logout(Request $request) {

        // Realiza o logout
        Auth::logout();

        // Invalida a sessão e gera uma nova
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redireciona para a tela de login
        return redirect('/login');

    }

}
