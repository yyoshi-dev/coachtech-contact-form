<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    // ログアウト時のリダイレクト先を/loginに設定
    public function toResponse($request)
    {
        return redirect('/login');
    }
}
