<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
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
     * Show all the courses to user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Course::all()->where('active', '=', 1);
        $follows = Follow::all()->where('user_id', '=', Auth::id());

        foreach ($courses as $course)
        {
            $user = User::where('id', '=', $course->user_id)->first();
            $course->professor_name = $user->name;

            if($follows != null)
            {
                foreach ($follows as $follow)
                {
                    if($course->id == $follow->course_id)
                    {
                        $course->following = 'Prijavljeni ste';
                    }
                }
            }
            else
                $course->following = 'Niste prijavljeni';


        }



        return view('user_pages.courses.show', ['courses' => $courses]);
    }

    public function follow($id)
    {
        $user_id = Auth::id();
        $course_id = (int)$id;

        $input['user_id'] = $user_id;
        $input['course_id'] = $course_id;


        Follow::create($input);

        return redirect('/student/courses')
            ->with('success','Uspešno ste se prijavili na kurs.');

    }

}
