@extends('layouts._base')

@section('content')
    <div class="container w-75">
        <h1>俺のTODO</h1>
        <div class="mb-5">
            <textarea class="form-control" name="store-content" rows="6"></textarea>
            <div class="w-50 mx-auto mt-5">
                <input type="submit" id="store-btn" class="btn btn-outline-primary btn-block"
                       data-store-url="{{ route('tasks.store') }}" value="記録">
            </div>
        </div>
        <ul id="task-lists" class="row">
            @foreach($tasks as $task)
                @include('tasks.list')
            @endforeach
        </ul>
    </div>
@endsection
