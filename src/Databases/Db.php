<?php

namespace App\Databases;

use PDO;
use PDOException;

class Db extends PDO
{
    private $_host          = '127.0.0.1';
    private $_username      = 'root';
    private $_password      = '';
    private $_dbname        = 'db_name';

    // database connection
    public $db = null;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_dbname . ';', $this->_username, $this->_password);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            die($err->getMessage());
        }
    }
}
