<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function notify_admin(Request $request)
    {
        $user = User::where('index_number', '=', $request->index_reset)->where('email', '=', $request->email_reset)->get();

        if($user->last())
        {
            $user = $user->last();
            $user->password_reset = 1;
            $user->save();
            return redirect()->back()->with('success', 'Uspešno ste poslali zahtev!');
        }
        return redirect()->back()->with('error', 'Pogrešno uneti podaci!');
    }


}
