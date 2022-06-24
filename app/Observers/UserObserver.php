<?php

namespace App\Observers;
use App\User;
use App\Notifications\NotificarNovoUsuario;
// use App\Notifications\TwoFactorCode;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $password = $user->generateRandomPassword();
        $user->notify(new NotificarNovoUsuario($password));
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated()
    {
        
       // $uservalid = $request->validate($user->validator());
        ///$user->update($user);
        //return redirect('/home');
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
