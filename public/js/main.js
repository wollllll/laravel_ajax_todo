var tasks = {
    dom: {
        csrfToken: $('meta[name="csrf-token"]').attr('content'),
        storeBtn: $('#store-btn'),
        editBtn: $('.edit-btn'),
        updateBtn: $('.update-btn'),
        taskLists: $('#task-lists')
    },
    modules: {
        _storeTask: function () {
            $.ajax({
                url: tasks.dom.storeBtn.data('store-url'),
                type: 'POST',
                dataType: 'json',
                data: {
                    '_token': tasks.dom.csrfToken,
                    'content': $('textarea[name="store-content"]').val()
                }
            }).done(function (data) {
                console.log(data);
            }).fail(function (data) {
                tasks.dom.taskLists.append(data.responseText);
                $('textarea[name="store-content"]').val('');
            });
        },
        _editTask: function (e) {
            var task = tasks.dom.taskLists.find('#task-list-' + $(e.target).data('task-id'));

            task.find('#show-task').toggle();
            task.find('#edit-task').toggle();
        },
        _updateTask: function (e) {
            var target = $(e.target);

            $.ajax({
                url: target.data('update-url'),
                type: 'POST',
                dataType: 'json',
                data: {
                    '_token': tasks.dom.csrfToken,
                    '_method': 'PUT',
                    'content': target.parents().find($('#content-' + target.data('task-id'))).val()
                }
            }).done(function (data) {
                var task = tasks.dom.taskLists.find('#task-list-' + data.id);

                task.find('#edit-task').toggle();
                task.find('#show-task').toggle();
                task.find('#show-task #content').text(data.content);
            }).fail(function () {
                alert('更新に失敗しました:(')
            });
        },
    },
    init: function () {
        tasks.dom.storeBtn.on('click', tasks.modules._storeTask);
        tasks.dom.updateBtn.on('click', tasks.modules._updateTask);
        tasks.dom.editBtn.on('click', tasks.modules._editTask);
    }
};

$(function () {
    tasks.init();
});



