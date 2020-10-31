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

    public function downloadAudio() {
        for($i = 2001; $i <= 2100; $i++) {
            $ch = curl_init('http://url-to-file.com/audio.mp3');
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_NOBODY, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
            $output = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($status == 200) {
                file_put_contents(dirname(__FILE__) . '/audio.mp3', $output);
            }
        }
    }
}
