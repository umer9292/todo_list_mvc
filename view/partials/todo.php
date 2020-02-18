<div class="container todoBackground">

    <header class="text-center text-light my-4">
        <h1 class="mb-4">Todo List</h1>
    </header>

    <form method="post" id="todoForm" class="add text-center my-5">
        <label for="addTodo" class="text-light"> Add a new todo... </label>
        <input class="form-control m-auto todoInput" type="text" id="todo" name="todo">
        <button type="button" class="btn btn-primary btn-block mt-2"  id="add-todo">Add</button>
    </form>

    <p id='total-todos'></p>
    <ul class="list-group todos mx-auto text-light" id="todos-list">
    </ul>


    <!-- Edit Todo Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Edit Todo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="modalTodoForm">
                    <label for="addTodo"> todo </label>
                    <input class="form-control" type="text" id="modalInput">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                <button type="button" class="btn btn-primary" id="updateBtn"> Update</button>
            </div>
            </div>
        </div>
    </div>

</div>