<?php


class Database extends mysqli
{
    function __construct() 
    {
        parent::__construct('localhost','root', '', 'db_api', 3306);
        $this->set_charset('utf8');
        $this->connect_error == NULL ? 'Connection Granted with the Database' : die('Connection Severed with the Database'); 
    }


}
