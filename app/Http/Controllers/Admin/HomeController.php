<?php

namespace App\Http\Controllers\Admin;

// Controller referente a página inicial de acesso dos usuários.
class HomeController
{
    // Função retorna dados selecionados para a view home.
    public function index()
    {
        $userName = \Auth::user()->name;
        $acesso = \Auth::user()->last_login_at;
        $acesso = date("d/m/Y H:i", strtotime($acesso));
        return view('home') -> with('name', $userName)->with('login', $acesso);
    }
    
}
