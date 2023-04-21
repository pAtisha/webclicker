<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class TestAnswerController extends Controller
{
    public function show_entire_test($id)
    {
        $test = Test::find($id);

        $questions = Question::where('test_id', '=', $id)->get();

        $answersArray = array();

        foreach ($questions as $index => $question)
        {
            $answers = Answer::where('question_id', '=', $question->id)->get()->toArray();
            $answersArray[$index] = $answers;
        }

        return view('user_pages.tests.test',
        [
            'test' => $test,
            'questions' => $questions,
            'answersArray' => $answersArray,
        ]);
    }
}
