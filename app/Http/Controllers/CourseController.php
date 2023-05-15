<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Follow;
use App\Models\Test;
use App\Models\Time;
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

    public function follow(Request $request, $id)
    {
        $user_id = Auth::id();

        $user = User::find($user_id);
        if($user->index_number == null)
            return redirect('/student/user/edit/'.$user_id)->with('error', 'Molimo Vas unesite broj indeksa!');

        $course_id = (int)$id;

        $course = Course::find($id);
        $course_password = $course->password;

        if($course_password != $request->password)
        {
            return redirect('/student/courses')
                ->with('error', 'Pogrešna šifra, pokušajte ponovo.');
        }

        $input['user_id'] = $user_id;
        $input['course_id'] = $course_id;


        Follow::create($input);

        return redirect('/student/courses')
            ->with('success','Uspešno ste se prijavili na kurs.');

    }

    public function unfollow($id)
    {
        $course = Course::find($id);

        $course_id = $course->id;


        $follow = Follow::where('user_id', '=', Auth::id())->where('course_id', '=', $course_id)->first();

        $follow->delete();

        return redirect('/student/courses')
            ->with('success', 'Uspešno ste se odjavili sa kursa.');
    }

    public function show_tests($id)
    {
        //check if user is following test
        $user = Auth::user();
        $course_id = $id;

        $follow = Follow::where('user_id', '=', $user->id)->where('course_id', '=', $course_id)->get();

        if($follow->first())
        {
            $course = Course::find($id);

            $tests = Test::where('course_id', '=', $id)->where('active', '=', 1)->get();

            $done_tests = Time::where('course_id', '=', $id)->where('user_id', '=', $user->id)->where('done', '=', 1)->get();

            $history_tests = array();

            foreach ($tests as $index => $test)
            {
                foreach ($done_tests as $done_test)
                {
                    if($test->id == $done_test->test_id)
                    {
                        $history_tests[] = [
                          'name' => $test->name,
                          'starting_time' => $done_test->created_at->format("d-m-Y H:i:s"),
                          'finishing_time' => $done_test->updated_at->format("d-m-Y H:i:s"),
                          'points' => $done_test->points,
                          'max_points' => $test->max_points,
                        ];
                        unset($tests[$index]);
                    }
                }
            }

            return view('user_pages.tests.show', ['course' => $course,
                'tests' => $tests,
                'history_tests' => $history_tests]);
        }
        else
            return redirect()->back()->with('error', 'Morate se prijaviti na kurs!');
    }


}
