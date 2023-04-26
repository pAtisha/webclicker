<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestAnswerController extends Controller
{
    public function show_entire_test($id)
    {
        $test = Test::find($id);

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
        {
            $time_rec = new Time;

            $time_rec->user_id = Auth::id();
            $time_rec->test_id = $id;

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
dd('dsa');
    }
}
