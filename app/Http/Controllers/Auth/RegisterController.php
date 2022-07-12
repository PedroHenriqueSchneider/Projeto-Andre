<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Esse controller é responsável pelo cadastro dos novos usuários assim como
    | sua validação e criação. 
    */

    use RegistersUsers;

    /**
     * Para onde redirecionar os usuários depois do cadastro.
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

    /**
     * Cria uma validação do novo cadastro.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:0', 'confirmed'],
        ]);
    }

    /**
    * Cria uma nova instância depois da validação do cadastro.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data, $notifiable)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

}
