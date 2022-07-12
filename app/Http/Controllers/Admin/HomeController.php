<?php

namespace App\Http\Controllers\Admin;

// Controller referente a página inicial de acesso dos usuários.
class HomeController
{
    // Função retorna dados selecionados para a view home.
    public function index()
    {
        return view('home');
    }
    
}
