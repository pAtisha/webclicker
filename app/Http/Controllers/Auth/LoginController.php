<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Follow;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->isStudent())
        {
            $follow = Follow::where('user_id', '=', $user->id)->get();
            if($follow->last())
            {
                $id = $follow[0]->course_id;
                return redirect('student/courses/'.$id);
            }
            return redirect('student/courses/');
        } elseif ($user->isProfessor())
        {
            $course = Course::where('user_id', '=', $user->id)->get();
            if($course->last())
            {
                $id = $course[0]->id;
                return redirect('professor/courses/'.$id);
            }
            return redirect('professor/courses');
        } else {
            return redirect('admin/users');
        }
    }

}
