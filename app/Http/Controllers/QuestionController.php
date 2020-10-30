<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;


class QuestionController extends Controller
{
    public function getQuestion() {
        $questions = Question::all();
        $categories = Category::all();
        // return Response::json($questions);
        return view('admin.question', ['categories' => $categories, 'questions' => $questions]);
    }

    public function addQuestion(Request $request) {

        $answer = array();
        for($i = 1; $i <= 20; $i++) {
            $key = 'answer' . $i;
            if($request[$key]) {
                array_push($answer, $request[$key]);
            }
        }
        $question = new Question();
        $question->category_id = $request->category_id;
        $question->question = $request->question;
        $question->answer = json_encode($answer);
        $question->save();
        // return Response::json($answer);
        return redirect()->route('admin.question')->with('info', 'question added');
    }

    public function deleteQuestion($id) {
        $question = Question::find($id);
        $question->delete();

        return redirect()->route('admin.question')->with('info', 'question deleted');
    }

    public function testAPI() {
        $questions = Question::all();
        $categories = Category::all();
        return Response::json($questions);
    }

}
