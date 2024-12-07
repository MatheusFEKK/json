<?php


class Database extends mysqli
{
    function __construct() 
    {
        parent::__construct('localhost','root', '', 'db_json', 3308);
        $this->set_charset('utf8');
        $this->connect_error == NULL ? 'Connection Granted with the Database' : die('Connection Severed with the Database'); 
    }
}
