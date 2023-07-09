<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
class GoogleController extends Controller
{
    public function signInwithGoogle()
    {
        return Socialite::driver('google')->stateless()
        ->
        redirect();
    }
    public function callbackToGoogle()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('gauth_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect('/student/courses');

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id'=> $user->id,
                    'gauth_type'=> 'google',
                    'password' => encrypt('admin@123'),
                ]);

                Auth::login($newUser);

                return redirect('/student/user/edit/'. $newUser->id)->with('success', 'Molimo Vas unesite Vaš broj indeksa!');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
