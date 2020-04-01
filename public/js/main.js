var tasks = {
    dom: {
        csrfToken: $('meta[name="csrf-token"]').attr('content'),
        storeBtn: $('#store-btn'),
        storeContent: $('textarea[name="store-content"]'),
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
                    'content': tasks.dom.storeContent.val()
                }
            }).done(function (data) {
                tasks.dom.taskLists.append()
            }).fail(function () {
                alert('保存に失敗しました:(')
            });
        },
        _editTask: function (e) {
            var target = $(e.target);
            var task = tasks.dom.taskLists.find('#task-list-' + $(target).data('task-id'));

            task.find('#hide-content').toggle();
            task.find('#show-content').toggle();
            task.find('#delete-btn').toggle();
            task.find('#created-at').toggleClass('offset-3');
            task.find('#update-btn').toggle();
            target.toggle();
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

                task.find('#hide-content').toggle();
                task.find('#show-content').toggle().text(data.content);
                task.find('#delete-btn').toggle();
                task.find('#created-at').toggleClass('offset-3');
                task.find('#update-btn').toggle();
                task.find('#edit-btn').toggle();
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



