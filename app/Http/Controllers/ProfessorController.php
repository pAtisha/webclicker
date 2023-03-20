<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $test->update();

        return redirect()->back()->with('success','Aktivnost testa ' . $name . ' uspešno izmenjena.');
    }
}
