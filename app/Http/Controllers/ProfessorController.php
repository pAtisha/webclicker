<?php

namespace App\Http\Controllers;

use App\Exports\TestExport;
use App\Exports\TestsExport;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Facades\Excel;

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

        return redirect('/professor/courses')->with('success','Vidljivost kursa ' . $name . ' uspešno izmenjena.');
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
        $tests = Test::where('user_id', '=', Auth::id())->where('course_id', '=', $id)->orderBy('position')->get();

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
        $input['max_points'] = 0;
        $position = Test::where('course_id', '=', $request->course_id)->max('position');
        $input['position'] = $position + 1;

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

        return redirect()->back()->with('success','Vidljivost testa ' . $name . ' uspešno izmenjena.');
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

        $questions = Question::where('test_id', '=', $id)->orderBy('position')->get();

        foreach ($questions as $question)
        {
            $answer = Answer::where('course_id', '=', $course_id)
                ->where('test_id', '=', $id)
                ->where('question_id', '=', $question->id)
                ->get();

            $question['answer'] = $answer;
        }

        return view('professor_pages.questions.show', ['test' => $test,
            'questions' => $questions,
            'course_id' => $course_id]);

    }

    public function create_question(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'type' => 'required'
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
        $position = Question::where('course_id', '=', $request->course_id)
            ->where('test_id', '=', $request->test_id)->max('position');
        $input['position'] = $position + 1;

        Question::create($input);

        return back()
            ->with('success','Pitanje uspešno dodato.');

    }

    public function active_question($id)
    {
        $question = Question::find($id);

        $answers = Answer::where('question_id', '=', $id)->get();

        foreach ($answers as $answer)
        {
            if($answer->points > 0 && $answer->active == 1 && $question->active == 1)
            {
                $test = Test::find($answer->test_id);
                $test->max_points -= $answer->points;
                $test->save();
            }

            if($answer->points > 0 && $answer->active == 1 && $question->active == 0)
            {
                $test = Test::find($answer->test_id);
                $test->max_points += $answer->points;
                $test->save();
            }
        }

        $question->active = !$question->active;

        $question->update();

        return redirect()->back()->with('success','Vidljivost pitanja uspešno izmenjena.');
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
                'type' => $request->type,
            ]
        );

        return redirect()->back()->with('success', 'Uspešno ste ažurirali pitanje.');
    }

    public function delete_question($id)
    {
        $question = Question::find($id);

        $answers = Answer::where('question_id', '=', $id)->get();

        foreach ($answers as $answer) {
            $test = Test::find($answer->test_id);
            if($answer->points > 0)
            {
                $test->max_points -= $answer->points;
                $test->save();
            }
        }

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

    public function show_answers($id)
    {
        $question = Question::find($id);

        $course_id = $question->course_id;

        $answers = Answer::where('question_id', '=', $question->id)->get();

        return view('professor_pages.answers.show', ['answers' => $answers,
            'course_id' => $course_id,
            'question' => $question]);
    }

    public function create_answer(Request $request)
    {
        $request->validate([
            'answer' => 'required',
            'points' => ['required', 'numeric'],
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

        $input['question_id'] = $request->question_id;
        $input['user_id'] = Auth::id();
        $question = Question::find($request->question_id);
        $input['test_id'] = $question->test_id;
        $input['course_id'] = $question->course_id;

        //change max_points
        if($request->points > 0)
        {
            $test = Test::find($question->test_id);
            $test->max_points += $request->points;
            $test->save();
        }

        Answer::create($input);

        return back()
            ->with('success','Odgovor uspešno dodat.');
    }

    public function active_answer($id)
    {
        $answer = Answer::find($id);

        if($answer->points > 0 && $answer->active == 1)
        {
            $test = Test::find($answer->test_id);
            $test->max_points -= $answer->points;
            $test->save();
        }

        if($answer->points > 0 && $answer->active == 0)
        {
            $test = Test::find($answer->test_id);
            $test->max_points += $answer->points;
            $test->save();
        }

        $answer->active = !$answer->active;

        $answer->update();

        return redirect()->back()->with('success','Vidljivost odgovora uspešno izmenjena.');
    }

    public function delete_answer($id)
    {
        $answer = Answer::find($id);

        if ($answer) {
            $test = Test::find($answer->test_id);
            if($answer->points > 0)
            {
                $test->max_points -= $answer->points;
                $test->save();
            }
        }

        $answer->delete();

        return redirect()->back()->with('success', 'Odgovor uspešno obrisan.');
    }

    public function edit_answer($id)
    {
        $data = Answer::find($id);

        return response()->json(['data' => $data]);
    }

    public function update_answer(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required',
            'points' => ['required', 'numeric'],
        ]);

        //change max_points
        if($request->points > 0)
        {
            $answer = Answer::find($id);
            $test = Test::find($answer->test_id);
            $test->max_points -= $answer->points;
            $test->max_points += $request->points;
            $test->save();
        }

        Answer::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'answer' => $request->answer,
                'points' => $request->points,
            ]
        );

        return redirect()->back()->with('success', 'Uspešno ste ažurirali odgovor.');
    }

    public function get_coursesJSON()
    {
        $data = Course::all();

        return response()->json(['data' => $data]);
    }

    public function get_questionsJSON($id)
    {
        $questions = Question::where('course_id', '=', $id)->get();

        $data = $questions->unique('question');

        $data->all();

        return response()->json(['data' => $data]);
    }

    public function create_existing_question(Request $request)
    {
        $test_id = $request->id_test;
        $course_id_selected = $request->course_old;
        $question_id = $request->question_old;

        $question = Question::find($question_id);

        $test = Test::find($test_id);

        $course_id = $test->course_id;

        $new_question = Question::create(
            [
                'user_id' => Auth::id(),
                'test_id' => $test_id,
                'course_id' => $course_id,
                'question' => $question->question,
                'active' => $question->active,
                'type' => $question->type,
                'position' => 0,
            ]
        );

        $answers = Answer::where('question_id', '=', $question_id)->get();
        foreach ($answers as $answer)
        {
            if($answer->points > 0)
            {
                $test->max_points += $answer->points;
                $test->save();
            }


            Answer::create([
                'question_id' => $new_question->id,
                'test_id' => $test_id,
                'course_id' => $course_id,
                'user_id' => Auth::id(),
                'answer' => $answer->answer,
                'points' => $answer->points,
                'active' => $answer->active,
            ]);
        }

        return redirect()->back()->with('success', 'Uspešno ste kopirali pitanje!');
    }

    public function export_test(Request $request)
    {
        $test_id = $request->test_id;

        $file_name = 'test_'.date('Y_m_d_H_i_s').'.csv';
        return Excel::download(new TestExport($test_id), $file_name);
    }

    public function export_all_tests(Request $request)
    {
        $course_id = $request->course_id;
        $test_ids = $request->test_id;

        $file_name = 'tests_'.date('Y_m_d_H_i_s').'.csv';
        return Excel::download(new TestsExport($course_id, $test_ids), $file_name);
    }

    public function update_test_positions(Request $request)
    {
        $positions = $request->input('positions');

        foreach ($positions as $position) {
            $record = Test::find($position['id']);
            $record->position = $position['position'];
            $record->save();
        }

        return response()->json(['success' => true]);
    }

    public function update_question_positions(Request $request)
    {
        $positions = $request->input('positions');

        foreach ($positions as $position) {
            $record = Question::find($position['id']);
            $record->position = $position['position'];
            $record->save();
        }

        return response()->json(['success' => true]);
    }
}
