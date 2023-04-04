<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ProfessorController extends Controller
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
     * Show all the courses to professor.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show_courses()
    {
        $user_id = Auth::id();

        $courses = Course::all()->where('user_id','=', $user_id);

        return view('professor_pages.courses.show', ['courses' => $courses]);
    }

    public function create_course(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $input = $request->all();

        if($request->has('active'))
        {
            if($input['active'] == "on")
                $input['active'] = 1;
            else
                $input['active'] = 0;
        }
        else
            $input['active'] = 0;

        $input['user_id'] = Auth::id();

        Course::create($input);

        return redirect('/professor/courses')
            ->with('success','Kurs uspešno dodat.');
    }

    public function active_course($id)
    {
        $course = Course::find($id);

        $name = $course->name;

        $course->active = !$course->active;

        $course->update();

        return redirect('/professor/courses')->with('success','Aktivnost kursa ' . $name . ' uspešno izmenjena.');
    }

    public function delete_course($id)
    {
        $course = Course::find($id);

        $name = $course->name;

        $course->delete();

        return redirect('/professor/courses')->with('success', 'Obrisali ste ' . $name . ' kurs.');
    }

    public function edit_course($id)
    {
        $data = Course::find($id);

        return response()->json(['data' => $data]);
    }

    public function update_course(Request $request, $id)
    {
        Course::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'name' => $request->name,
                'password' => $request->password,
            ]
        );

        return redirect('/professor/courses')->with('success', 'Uspešno ste ažurirali kurs.');
    }

    public function show_tests($id)
    {
        $course = Course::find($id);
        $tests = Test::where('user_id', '=', Auth::id())->where('course_id', '=', $id)->get();

        return view('professor_pages.tests.show', ['course' => $course,
        'tests' => $tests]);
    }

    public function create_test(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'time' => ['required', 'numeric', 'max:60', 'min:1'],
        ]);

        $input = $request->all();

        if($request->has('active'))
        {
            if($input['active'] == "on")
                $input['active'] = 1;
            else
                $input['active'] = 0;
        }
        else
            $input['active'] = 0;

        $input['user_id'] = Auth::id();
        $input['course_id'] = $request->course_id;
        $input['open'] = 0;


        Test::create($input);

        return redirect('/professor/courses/'. $input['course_id'])
            ->with('success','Test uspešno dodat.');
    }

    public function delete_test($id)
    {
        $test = Test::find($id);

        $test->delete();

        return redirect()->back()->with('success', 'Test uspešno obrisan.');
    }

    public function edit_test($id)
    {
        $data = Test::find($id);

        return response()->json(['data' => $data]);
    }

    public function update_test(Request $request, $id)
    {
        Test::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'name' => $request->name,
                'password' => $request->password,
                'time' => $request->time,
            ]
        );

        return redirect()->back()->with('success', 'Uspešno ste ažurirali test.');
    }

    public function active_test($id)
    {
        $test = Test::find($id);

        $name = $test->name;

        $test->active = !$test->active;

        if($test->open == 1)
            $test->open = 0;

        $test->update();

        return redirect()->back()->with('success','Aktivnost testa ' . $name . ' uspešno izmenjena.');
    }

    public function open_test($id)
    {
        $test = Test::find($id);
        if($test->active == 0)
            return redirect()->back()->with('error', 'Test prvo mora biti aktivan!');

        $test->open = !$test->open;

        $test->update();

        //$loggedUsers = $this->getLoggedInUsers();

        //dd($loggedUsers);

        return redirect()->back()->with('success', 'Otvorenost testa je sada izmenjena.');
    }

    public function show_questions($id)
    {
        $test = Test::find($id);
        $course_id = $test->course_id;

        $questions = Question::where('test_id', '=', $id)->get();

        return view('professor_pages.questions.show', ['test' => $test,
            'questions' => $questions,
            'course_id' => $course_id]);

    }

    public function create_question(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'points' => ['required', 'numeric', 'max:60', 'min:1'],
        ]);

        $input = $request->all();

        if($request->has('active'))
        {
            if($input['active'] == "on")
                $input['active'] = 1;
            else
                $input['active'] = 0;
        }
        else
            $input['active'] = 0;

        $input['user_id'] = Auth::id();
        $input['test_id'] = $request->test_id;
        $input['course_id'] = Test::find($input['test_id'])->course_id;

        Question::create($input);

        return back()
            ->with('success','Pitanje uspešno dodato.');



    }

    public function active_question($id)
    {
        $question = Question::find($id);

        $question->active = !$question->active;

        $question->update();

        return redirect()->back()->with('success','Aktivnost pitanja uspešno izmenjena.');
    }

    public function edit_question($id)
    {
        $data = Question::find($id);

        return response()->json(['data' => $data]);
    }

    public function update_question(Request $request, $id)
    {
        Question::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'question' => $request->question,
                'points' => $request->points,
            ]
        );

        return redirect()->back()->with('success', 'Uspešno ste ažurirali pitanje.');
    }

    public function delete_question($id)
    {
        $question = Question::find($id);

        $question->delete();

        return redirect()->back()->with('success', 'Pitanje uspešno obrisano.');
    }


//    public function getLoggedInUsers()
//    {
//        // Get all the session IDs from Redis
//        $sessionIds = Redis::connection()->keys('laravel:session:*');
//
//        // Filter out the session IDs that don't belong to authenticated users
//        $authenticatedSessionIds = collect($sessionIds)->filter(function ($id) {
//            $data = Redis::connection()->get($id);
//            $userData = unserialize($data)['_auth_user_id'] ?? null;
//            return $userData !== null;
//        });
//
//        // Use the session IDs to get the authenticated users
//        $users = $authenticatedSessionIds->map(function ($id) {
//            $data = Redis::connection()->get($id);
//            $userData = unserialize($data)['_auth_user_id'];
//            return Cache::remember('user:'.$userData, 60, function () use ($userData) {
//                return Auth::loginUsingId($userData);
//            });
//        });
//
//        return $users;
//    }
}
