var tasks = {
    dom: {
        storeBtn: $('#store-btn'),
        editBtn: $('.edit-btn'),
        updateBtn: $('.update-btn'),
        deleteBtn: $('.delete-btn'),
        showMoreBtn: $('#show-more-btn')
    },
    modules: {
        /**
         * taskController@storeにpostで投げる
         *
         * @private
         */
        _storeTask: function () {
            $.ajax({
                url: tasks.dom.storeBtn.data('store-url'),
                type: 'POST',
                dataType: 'json',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'content': $('textarea[name="store-content"]').val()
                }
            }).done(function (data) {
                console.log(data);
            }).fail(function (data) {
                $('#task-lists').prepend(data.responseText);
                $('textarea[name="store-content"]').val('');
            });
        },
        /**
         * タスク編集画面の表示
         *
         * @param e
         * @private
         */
        _editTask: function (e) {
            var task = $('#task-lists').find('#task-list-' + $(e.target).data('task-id'));

            task.find('#show-task').toggle();
            task.find('#edit-task').toggle();
        },
        /**
         * taskController@updateにpost(put)で投げる
         *
         * @param e
         * @private
         */
        _updateTask: function (e) {
            var target = $(e.target);

            $.ajax({
                url: target.data('update-url'),
                type: 'POST',
                dataType: 'json',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    '_method': 'PUT',
                    'content': target.parents().find($('#content-' + target.data('task-id'))).val()
                }
            }).done(function (data) {
                var task = $('#task-lists').find('#task-list-' + data.id);

                task.find('#edit-task').toggle();
                task.find('#show-task').toggle();
                task.find('#show-task #content').text(data.content);
            }).fail(function () {
                alert('更新に失敗しました:(')
            });
        },
        /**
         * taskController@destroyにpost(delete)で投げる
         *
         * @param e
         * @private
         */
        _deleteTask: function (e) {
            var target = $(e.target);

            $.ajax({
                url: target.data('delete-url'),
                type: 'POST',
                dataType: 'json',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    '_method': 'DELETE',
                }
            }).done(function (data) {
                $('#task-lists').find('#task-list-' + data.id).remove();
            }).fail(function () {
                alert('削除に失敗しました:(')
            });
        },
        _showMore: function (e) {
            var target = $(e.target);

            $.ajax({
                url: target.data('show-more-url'),
                type: 'GET',
                dataType: 'json',
            }).done(function (data) {
                console.log(data);
            }).fail(function (data) {
                $('#task-lists').prepend(data.responseText);
            });
        }
    },
    init: function () {
        tasks.dom.storeBtn.on('click', tasks.modules._storeTask);
        tasks.dom.updateBtn.on('click', tasks.modules._updateTask);
        tasks.dom.editBtn.on('click', tasks.modules._editTask);
        tasks.dom.deleteBtn.on('click', tasks.modules._deleteTask);
        tasks.dom.showMoreBtn.on('click', tasks.modules._showMore);
    }
};

$(function () {
    tasks.init();
});
