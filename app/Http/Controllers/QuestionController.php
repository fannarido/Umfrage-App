<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:api")->only("store", "update");
    }

    /**
     *  GET api/questions
     *  to get all questions
     */
    public function index(Request $request)
    {
        try {
            $questions = Question::where("group_id", $request->group_id)
                ->with("answers")
                ->get();
            return response()->json([
                "success" => true,
                "data" => $questions,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  POST api/groups
     *  to create a new group
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $question = new Question();
            $question->heading = $request->heading;
            $question->sub_heading = $request->sub_heading;
            $question->group_id = $request->group_id;
            $question->save();

            foreach ($request->answers as $answer) {
                Answer::create([
                    "question_id" => $question->id,
                    "answer" => $answer["answer"],
                ]);
            }
            DB::commit();
            return response()->json([
                "success" => true,
                "data" => $question,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  GET api/categories/{category}
     *  to show a category
     */
    public function show(Question $question, Request $request)
    {
        try {
            return response()->json([
                "success" => true,
                "data" => $question,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  PUT/PATCH api/categories/{category}
     *  to update a category
     */
    public function update(Request $request, Question $question)
    {
        DB::beginTransaction();
        try {
            $question->heading = $request->heading;
            $question->sub_heading = $request->sub_heading;
            $question->group_id = $request->group_id;
            $question->update();

            $question->answers()->delete();

            foreach ($request->answers as $answer) {
                Answer::create([
                    "question_id" => $question->id,
                    "answer" => $answer["answer"],
                ]);
            }
            DB::commit();
            return response()->json([
                "success" => true,
                "data" => $question,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * DELETE api/categories/{category}
     * to delete a category
     */
    public function destroy(Question $question)
    {
        try {
            $question->delete();
            return response()->json([
                "success" => true,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
