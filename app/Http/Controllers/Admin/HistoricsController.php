<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;

// Controller responsável pelo histórico de entrada dos usuários

class HistoricsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // função pega todos os historicos de usuários e retorna para a view index ter acesso.
    public function index()
    {
        $historics = User::all();
        return view('admin.historics.index', compact('historics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // função cria um array contendo os dados de email, nome, data de último login e id do usuário.
     // Adiciona dentro desse array os dados referidos ao ultimo login de cada um.
     // Trata essas informações do tipo json.
     // Retorna para a view show essas informações.
    public function show(User $user)
    {
            abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
            $user->load('roles');

            if(!isset($arrLogins)) 
                $arrLogins = array();
        
            $logados = DB::table('historics')->select('email', 'name', 'last_login_at', 'id')->get();
            array_push($arrLogins, $logados);
            $ls = json_decode($arrLogins[0], true);
            return view('admin.historics.show', ['logado' => $ls]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
