<?php
require_once 'baseController.php';
class todoController  extends BaseController
{
    public function __construct() 
    {
        parent::__construct();
        include('model/todoModel.php');
        $this->obj = new homeModel();
    }
    public function index()
    {
        $this->loadView('view/partials/todo.php');
    }
    public function fetch()
    {
        $data = $this->obj->todo();
        $response = [
            'success' => true,
            'total' => count($data),
            'todos' => $data
        ];
        echo json_encode($response);
        exit();
    }
    public function create()
    {   
        if (isset($_POST) && !empty($_POST)) {
            $todo = $_POST['todo'];
            $data = $this->obj->addTodo($todo);
            if ($data) {
               $response = [
                   'success' => true,
                   'message' => 'Todo is created!!'
               ];
            } else {     
                $response = [
                    'success' => false,
                    'message' => 'Unable to create Todo'
                ];
            }
            echo json_encode($response);
            exit();
        }
    }
    public function delete()
    {
        if (isset($_POST)) {
            $id = $_POST['todoId'];
            $todo = $this->obj->delTodoById($id);
            if ($todo) {
                $response = [
                    'success' => true,
                    'message' => 'Todo is successful delete'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Todo is not deleted!!'
                ];
            }
        
            echo json_encode($response);
            exit();
        }
    }
    public function edit()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $todo = $this->obj->getTodoById($id);
            $response = [
                'success' => true,
                'id' => $id,
                'todo' => isset($todo['todo']) ? $todo['todo'] : null 
            ];
            
            echo json_encode($response);
            exit();
        }            
    }
    public function update()
    {
        if (isset($_POST) && !empty($_POST)) {
            $id = $_POST['todoId'];
            $todo = $_POST['todo'];  
            $data = $this->obj->updateTodoById($id, $todo);
            if ($data) {
                $response = [
                    'success' => true,
                    'message' => 'Todo is update succesful'
                ];
            } else {     
                $response = [
                    'success' => false,
                    'message' => 'Unable to update Todo'
                ];
            }
            echo json_encode($response);
            exit();
        }
    }  
}