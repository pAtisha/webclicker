<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
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

        return response()->json([ 'success' => true ]);
    }
}
