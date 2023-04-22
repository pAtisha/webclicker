<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use DateInterval;
use Illuminate\Http\Request;

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
