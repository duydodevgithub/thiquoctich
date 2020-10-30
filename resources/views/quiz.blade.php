@extends('layouts.master')

@section('content')
    <h1>Quiz</h1>
    @foreach($data as $key => $value)
    <pre>
        {{ 
            print_r($value->question)
        }}
    </pre>
    <br>
    @endforeach
   
@endsection