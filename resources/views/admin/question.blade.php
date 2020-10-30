@extends('layouts.master')

@section('content')
    <form action="{{ route('admin.addQuestion') }}" method="post">
        <div class="form-group">
            <label for="category_id">Category name</label>
            <select class="form-control" id="category_id" name="category_id">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $cat->id == 16 ? 'selected' : '' }} >{{ $cat->name }}</option>
                @endforeach
              </select>
            <label for="question">Question</label>
            <input name="question" type="text" class="form-control" id="question">
            <div id="answerList">
                <label for="answer1">Answer</label>
                <input name="answer1" type="text" class="form-control" id="answer1">
            </div>
            <button id="addMoreAnswer">Add more answer</button>

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        {{ csrf_field() }}
  </form>
  @if(Session::has('info'))
    <p>{{ Session::get('info') }}</p>
  @endif
  <div>
      @if(!count($questions))
        <h3>No question found, please add question</h3>
        @else
        <h2>Question list</h2>
        <ul>
            @foreach($questions as $q)
                <li>
                    {{ $q->question }}
                    <a href="{{ route('admin.deleteQuestion',['id' => $q->id]) }}">Delete</a>
                </li>
            @endforeach
        </ul>
      @endif
  </div>
  <script>
    $(document).ready(function(){
        var num = 1;
        $("#addMoreAnswer").click(function(e){
            e.preventDefault();
            num += 1;
            let html = '';
            html += '<label for="answer' + num + '">Answer</label>';
            html += '<input name="answer' + num + '" type="text" class="form-control" id="answer' + num +'">';
            $("#answerList").append(html)
        });
    });
    </script>
@endsection

