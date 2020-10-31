<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;


use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;

class ApiController extends Controller
{
    public function getQuestion() {
        $questions = Question::take(10)->get();
        return Response::json($questions);
    }

    public function getCategories() {
        $cat = Category::all();
        return Response::json($cat);
    }
}
