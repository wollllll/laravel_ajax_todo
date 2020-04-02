<ol id="task-list-{{ $task->id }}" class="col-lg-6 my-1">
    <div class="card task-content"
         data-modal-content="{{ $task->content }}">
        <div id="show-task" class="card-body">
            <div class="row">
                <div id="content" class="col-12 mb-3">
                    {!! nl2br(e($task->content)) !!}
                </div>
                <div class="col-3">
                    <button type="button" id="edit-btn"
                            class="edit-btn btn btn-sm btn-outline-primary w-100"
                            data-task-id="{{ $task->id }}">編集
                    </button>
                </div>
                <div class="col-6 offset-3 text-right">
                    <span>{{ $task->created_at->format('Y-m-d H:i') }}</span>
                </div>
            </div>
        </div>
        <div id="edit-task" class="card-body" style="display: none">
            <div class="row">
                <div class="col-12 mb-3">
                                <textarea id="content-{{ $task->id }}" class="form-control"
                                          rows="5">{!! nl2br(e($task->content)) !!}</textarea>
                </div>
                <div class="col-3">
                    <button type="button" id="update-btn"
                            class="update-btn btn btn-sm btn-outline-success w-100"
                            data-task-id="{{ $task->id }}"
                            data-update-url="{{ route('tasks.update', $task) }}">
                        更新
                    </button>
                </div>
                <div id="delete-btn" class="col-3">
                    <button type="button" id="delete-btn"
                            class="delete-btn btn btn-sm btn-outline-danger w-100"
                            data-task-id="{{ $task->id }}"
                            data-delete-url="{{ route('tasks.delete', $task) }}">
                        削除
                    </button>
                </div>
                <div id="created-at" class="col-6 text-right">
                    <span>{{ $task->created_at->format('Y-m-d H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</ol>
