<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Course;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestAnswer;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestAnswerController extends Controller
{
    public function show_entire_test($id)
    {
        $test = Test::find($id);

        if($test->open != 1)
            return redirect()->back()->with('error', 'Profesor je zatvorio test!');

        $seconds = $test->time * 60;

        $time = gmdate("i:s", $seconds);

        $questions = Question::where('test_id', '=', $id)->where('active', '=' , 1)->get();

        $answersArray = array();

        foreach ($questions as $index => $question)
        {
            $answers = Answer::where('question_id', '=', $question->id)->where('active', '=', 1)->get()->toArray();
            $answersArray[$index] = $answers;
        }

        //Store starting time to db
        $result = Time::where('user_id', '=', Auth::id())->where('test_id', '=', $id)->get();
        if(!$result->isEmpty())
        {
            if($result[0]->done == 0)
            {
                $created_time = $result[0]->created_at->timestamp;
                $current_time = date_create('now');
                $current_time = $current_time->getTimestamp();
                $time_to_sub = $created_time - $current_time;
                $time = $seconds + $time_to_sub;
                if($time <= 0)
                    return redirect()->back()->with('error', 'Test ne možete raditi sada. Započeli ste test: ' . $result[0]->created_at->toString());
                $time = gmdate("i:s", $time);
            }
            else
                return redirect()->back()->with('error', 'Ovaj test ste već radili.');

        }
        else
        {
            $time_rec = new Time;

            $time_rec->user_id = Auth::id();
            $time_rec->test_id = $id;
            $time_rec->done = 0;
            $time_rec->points = 0;
            $time_rec->course_id = $test->course_id;

            $time_rec->save();
        }

        return view('user_pages.tests.test',
        [
            'test' => $test,
            'questions' => $questions,
            'answersArray' => $answersArray,
            'time' => $time
        ]);
    }

    public function submit_answers(Request $request)
    {
        //static
        $user_id = Auth::id();
        $test_id = $request->test_id;
        $course_id = Test::find($test_id)->course_id;

        //done
        $get_time = Time::where('user_id', '=', Auth::id())->where('test_id', '=', $test_id)->get();
        $get_time[0]->done = 1;
        $get_time[0]->save();

        //points counter
        $points = 0;

        $questions = Question::where('test_id', '=', $test_id)->get();

        foreach ($questions as $index => $question)
        {
            if($question->type == "single")
            {
                $answer_value = "answer_single" . $index;
                $answer = $request->$answer_value;
                $answer_db = Answer::where('test_id', '=', $test_id)
                    ->where('answer', '=', $answer)
                    ->where('question_id', '=', $question->id)
                    ->get(['answer', 'points']);

                if($answer_db->isEmpty())
                    continue;

                $answer_db = $answer_db[0];

                //Add points
                $points += $answer_db->points;

                //store answer in DB
                TestAnswer::create([
                    'user_id' => $user_id,
                    'test_id' => $test_id,
                    'question_id' => $question->id,
                    'course_id' => $course_id,
                    'answer' => $answer_db->answer,
                    'points' => $answer_db->points
                ]);
            }
            else
            {
                $answer_value = "answer_multi" . $index;
                $answers = $request->$answer_value;

                if($answers)
                {
                    foreach ($answers as $answer)
                    {
                        $answer_db = Answer::where('test_id', '=', $test_id)->where('answer', '=', $answer)->get(['answer', 'points']);

                        if($answer_db->isEmpty())
                            continue;

                        $answer_db = $answer_db[0];

                        //add points
                        $points += $answer_db->points;

                        //store answer in DB
                        TestAnswer::create([
                            'user_id' => $user_id,
                            'test_id' => $test_id,
                            'question_id' => $question->id,
                            'course_id' => $course_id,
                            'answer' => $answer_db->answer,
                            'points' => $answer_db->points
                        ]);
                    }
                }
            }
        }

        //store points in times table
        $get_time[0]->points = $points;
        $get_time[0]->save();

        return redirect('/student/courses/'.$course_id)->with('success', 'Test je uspešno završen!');

    }

    public function show_entire_test_with_password(Request $request, $id)
    {
        $test = Test::find($id);

        if($request->password == $test->password)
            return redirect('student/test/create/'.$id);
        else
            return redirect()->back()->with('error', 'Pogrešna lozinka!');

    }
}
