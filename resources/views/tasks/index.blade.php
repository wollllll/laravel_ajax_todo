<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>todo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body class="my-5">
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
            <ol id="task-list-{{ $task->id }}" class="col-lg-6 my-2">
                <div class="card task-content"
                     data-modal-content="{{ $task->content }}">
                    <div class="card-body">
                        <div id="show-content">
                            {!! nl2br(e($task->content)) !!}
                        </div>
                        <div id="hide-content" style="display: none">
                            <textarea id="content-{{ $task->id }}" class="form-control"
                                      rows="5">{{ $task->content }}</textarea>
                        </div>
                    </div>
                    <div class="row mx-1 mb-3">
                        <div class="col-3">
                            <button type="button" id="edit-btn" class="edit-btn btn btn-sm btn-outline-primary w-100"
                                    data-task-id="{{ $task->id }}">編集
                            </button>
                            <button type="button" id="update-btn"
                                    class="update-btn btn btn-sm btn-outline-success w-100"
                                    data-task-id="{{ $task->id }}" data-update-url="{{ route('tasks.update', $task) }}"
                                    style="display: none">
                                更新
                            </button>
                        </div>
                        <div id="delete-btn" class="col-3" style="display: none">
                            <button type="button" id="delete-btn" class=".delete-btn btn btn-sm btn-outline-danger w-100"
                                    data-task-id="{{ $task->id }}" data-delete-url="{{ route('tasks.delete', $task) }}">
                                削除
                            </button>
                        </div>
                        <div id="created-at" class="col-6 offset-3 text-right">
                            <span class="mr-2">{{ $task->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                    </div>
                </div>
            </ol>
        @endforeach
    </ul>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
