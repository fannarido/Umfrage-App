<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Result;
use Exception;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     *  POST api/groups
     *  to create new answers
     */
    public function store(Request $request)
    {
        try {
            $questions = $request->questions;
            foreach ($questions as $key => $question) {
                foreach ($question["answers"] as $key => $answer) {
                    if ($answer["isActive"] === true) {
                        Result::create([
                            'question_id' => $question['id'],
                            'answer_id' => $answer['id'],
                        ]);
                    }
                }
            }
            return response()->json([
                "success" => true,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function index(Request $request)
    {
        try {
            $answers = Answer::where('question_id', $request->question_id)->get();
            $series = [];
            $labels = [];
            $isAnswers = false;
            for ($i = 0; $i < count($answers); $i++) {
                array_push($labels, $answers[$i]['answer']);
                $selected_results = Result::where("question_id", $request->question_id)->where("answer_id", $answers[$i]['id'])->get();
                array_push($series, count($selected_results));
                if (count($selected_results) > 0) {
                    $isAnswers = true;
                }
            }
            return response()->json([
                "success" => true,
                "series" => $series,
                "labels" => $labels,
                "isAnswers" => $isAnswers,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
