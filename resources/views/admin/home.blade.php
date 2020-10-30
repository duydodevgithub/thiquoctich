@extends('layouts.master')

@section('content')
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.question') }}">Manage Question</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.category') }}">Manage Category</a>
        </li>
    </ul>
@endsection