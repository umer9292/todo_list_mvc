<?php
/**
 * Created by PhpStorm.
 * User: Umer
 * Date: 1/22/2020
 * Time: 12:23 PM
 */

session_start();
class dbConnect
{
    private $server = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbName = 'mvc';
    public $db_conn;

    public function __construct()
    {

        $this->db_conn = mysqli_connect($this->server, $this->user, $this->password, $this->dbName);
        if (!$this->db_conn){
            die(mysqli_connect_error($this->db_conn));
        }

    }
}

//$db_obj = new db_connect();