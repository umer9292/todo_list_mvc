    <footer class="footer">
        <div class=" text-center">© 2020 Copyright:
            <a href="http://portfolio.seersol.com/"> seersol.com</a>
        </div>
    </footer>

    <script src="public/js/jquery-3.4.1.min.js" ></script>
    <script src="public/js/popper.min.js" ></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/toastr.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        const todoBtn = $('#add-todo'); //todo button Selector
        const todoInput = $("#todo"); // todo input selector
        const updateTodoModal = $("#modal") // update todo modal selector
        const modalTodoInput = $("#modalInput"); // modal todo input selector
        const todoUpdateBtn = $("#updateBtn"); // modal todo update button selector
        var selectedId = null;

        const fetchTodos = () => {
            $.ajax({
                type: 'GET',
                url: 'http://localhost/2019/mvc2/index.php?controller=todo&function=fetch',
                success: function(res) {
                    const parseRes = JSON.parse(res);
                    const {
                        success,
                        todos,
                        total
                    } = parseRes;
                    if (success) {
                        var todosHtml = '';
                        if (total > 0) {
                            $('#total-todos').html('Total Todos: ' + total);
                            $.map(todos, function(todo, key) {
                                todosHtml += '<li class="list-group-item d-flex justify-content-between align-items-center">' + todo.todo + '<span><a class="edit-todo text-success mr-2" data-todo-id="' + todo.id + '" href="javascript:void(0)"> <i class="fa fa-edit"></i> </a> <a  class="del-todo text-danger" data-todo-id="' + todo.id + ' " href="javascript:void(0)"> <i class="fas fa-trash-alt"></i> </a><span></li>'
                            });
                            $('#todos-list').html(todosHtml)
                        } else {
                            $('#total-todos').html('Total Todos: ' + 0);
                            $('#todos-list').html('<li class="list-group-item d-flex justify-content-between align-items-center">No, Todo Found :)</li>')
                        }
                    } else {
                        toastr.info('Unable to fetch todos')
                    }
                }
            })
        }

        fetchTodos();

        todoBtn.click(function() {
            const todo = todoInput.val();
            if ($.trim(todo).length > 0) {
                $.ajax({
                    type: 'POST',
                    url: 'http://localhost/2019/mvc2/index.php?controller=todo&function=create',
                    data: {
                        todo
                    },
                    success: function(res) {
                        const parseRes = JSON.parse(res);
                        if (parseRes.success) {
                            todoInput.val(null);
                            fetchTodos();
                            toastr.success(parseRes.message)
                        } else toastr.error(parseRes.message)
                    }
                })
            } else {
                toastr.info('Please write todo!!')
            }
        })

        $('#todos-list').on('click', '.del-todo', function() {
            const todoId = $(this).data('todo-id');
            $.ajax({
                type: 'POST',
                url: `http://localhost/2019/mvc2/index.php?controller=todo&function=delete&id=${todoId}`,
                data: {
                    todoId
                },
                success: function(res) {
                    const parseRes = JSON.parse(res);
                    if (parseRes.success) {
                        fetchTodos();
                        toastr.success(parseRes.message)
                    } else toastr.error(parseRes.message)
                }
            })
        })

        $('#todos-list').on('click', '.edit-todo', function() {
            const todoId = $(this).data('todo-id');
            selectedId = todoId;
            $.ajax({
                type: 'GET',
                url: `http://localhost/2019/mvc2/index.php?controller=todo&function=edit&id=${todoId}`,
                success: function(res) {
                    const parseRes = JSON.parse(res)
                    const {
                        success,
                        todo
                    } = parseRes;

                    if (success) {
                        updateTodoModal.modal('show');
                        modalTodoInput.val(todo);
                    }
                }
            })
        })

        todoUpdateBtn.click(function() {
            const todo = modalTodoInput.val();;
            $.ajax({
                type: 'POST',
                url: 'http://localhost/2019/mvc2/index.php?controller=todo&function=update',
                data: {
                    todoId: selectedId,
                    todo
                },
                success: function(res) {
                    const parseRes = JSON.parse(res);
                    if (parseRes.success) {
                        updateTodoModal.modal('hide');
                        toastr.success(parseRes.message);
                        fetchTodos();
                    } else toastr.error(parseRes.message)
                }
            })
        })
    })
    </script>
        
</body>
</html>