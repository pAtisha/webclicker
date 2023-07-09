<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user_pages.profile.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($request->index_number != null)
        {
            if($user->index_number != $request->index_number)
            {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'index_number' => ['required', 'numeric', 'max:999999', 'min:9999', 'unique:users'],
                ]);
            }
            else
            {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'index_number' => ['required', 'numeric', 'max:999999', 'min:9999'],
                ]);
            }
        }

        $currentPassword = $user->password;

        if($request->old_password) {
            if (Hash::check($request->old_password, $currentPassword)) {
                if ($request->new_password) {
                    if($request->new_password === $request->password_confirmation)
                    {
                        if(strlen($request->new_password) >= 8) {
                            $user->password = Hash::make($request->new_password);
                            $user->save();
                        }
                        else
                            return redirect()->back()->with('error', 'Molimo Vas da šifra sadrži minimum 8 karaktera.');
                    }
                    else
                        return redirect()->back()->with('error', 'Nova šifra i potvrdna šifra se ne poklapaju.');
                }
                else
                    return redirect()->back()->with('error', 'Morate uneti novu šifru.');
            }
            else
                return redirect()->back()->with('error', 'Pogrešna stara šifra.');
        }

        $request->request->remove('new_password');
        $request->request->remove('old_password');
        $request->request->remove('password_confirmation');

        $user->update($request->all());

        return redirect($request->route()->getPrefix().'/courses')->with('success','Profil je uspešno izmenjen');
    }
}
