<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuizController extends Controller
{
    public function getQuestions() {
        $results = Question::all();

        return view('quiz', ['data' => $results]);
    }
}
