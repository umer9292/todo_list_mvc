<?php
class homeModel extends dbConnect
{
    public function __construct() 
    {
        parent::__construct();
    }
    public function addTodo($todo)
    {
        $conn = $this->db_conn;
        $todoSql = 'INSERT INTO todos(todo) VALUES ("'.$todo.'")';
        $data = mysqli_query($conn, $todoSql) or mysqli_error($conn);
        return $data;
    }
    public function todo()
    {
        $todos = [];
        $conn = $this->db_conn;
        $query = 'SELECT * FROM todos order by id DESC';
        $result = mysqli_query($conn, $query) OR die(mysqli_error($conn));
        while( $row = mysqli_fetch_assoc( $result )){
            array_push( $todos, $row );
        }
        return $todos;
    }
    public function getTodoById($id)
    {
        $conn = $this->db_conn;
        $query = 'SELECT todo FROM todos WHERE id="'.$id.'"';
        $res = mysqli_query($conn, $query) or mysqli_error($conn);
        return  mysqli_fetch_assoc( $res );
    }
    public function updateTodoById($id, $todo)
    {
        $conn = $this->db_conn;
        $sql = 'UPDATE todos SET
                todo ="'.$todo.'",
                updated_at = "'.date('Y-m-d h:i:s').'"
                WHERE id ="'.$id.'"
                ';
        $data = mysqli_query($conn, $sql) or mysqli_error($conn);
        return $data;
    }
    public function delTodoById($id)
    {
        $conn = $this->db_conn;
        $query = 'DELETE FROM todos WHERE id= "'.$id.'"';
        $todo = mysqli_query($conn, $query) or mysqli_error($conn);
        return $todo;
    }
}