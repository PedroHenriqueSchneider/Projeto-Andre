<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\TwoFactorCode;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Esse controller é responsável por autenticar os usuários da aplicação e
    | redireciona-los para a página principal. 
    |
    */

    use AuthenticatesUsers;

    /**
     * Redireciona o usuário depois do login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Cria uma nova instância de controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * O usuário foi autenticado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */

    // Função responsável pela autenticação dos usuários.
    // Gera o código de fator.
    // Notifica esse novo código ao email do usuário.
    // Atualiza os dados da data do último login e o ip de onde está logando.
    // Insere na tabela "historics" os dados de nome, email e a data de último login
    //para que possa ser tratado na inserção do array de histórico dos usuários.
    protected function authenticated(Request $request, $user)
    {
        $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode());
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
        DB::insert('INSERT INTO historics (name, email, last_login_at, id) VALUES (?, ?, ?, ?)', [$user->name, $user->email, $user->last_login_at, $user->id]);
        
    }

}
