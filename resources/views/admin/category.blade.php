@extends('layouts.master')

@section('content')
    <form action="{{ route('admin.addCategory') }}" method="post">
        <div class="form-group">
            <label for="category">Add new category</label>
            <input name="category_name" type="text" class="form-control" id="category">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        {{ csrf_field() }}
  </form>
  @if(Session::has('info'))
    <p>{{ Session::get('info') }}</p>
  @endif
  <div>
      @if(!count($category))
        <h3>No category found, please add category</h3>
        @else
        <h2>Category list</h2>
        <ul>
            @foreach($category as $cat)
                <li>
                    {{ $cat->name }}
                    <a href="{{ route('admin.deleteCategory',['id' => $cat->id]) }}">Delete</a>
                </li>
            @endforeach
        </ul>
      @endif
  </div>
@endsection