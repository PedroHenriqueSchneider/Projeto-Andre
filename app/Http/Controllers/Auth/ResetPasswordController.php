<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | Esse controller é reponsável pelas requisições de mudança de senha.
    |
    */

    use ResetsPasswords;

    /**
     * Onde redireciona os usuários após a mudança de senha.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Cria uma nova instância do controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
