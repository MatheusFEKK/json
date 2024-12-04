<?php

require_once 'connection/Connection.php';


class Cliente
{
    public static function getAll()
    {
        $db = new Database();
        $sql = "SELECT * FROM clientes";
        $result = $db->query($sql);
        $data = [];

        if ($result && $result->num_rows)
        {
            while ($row = $result->fetch_assoc()) 
            {
                $data[] = [
                    'id' =>  $row['id'],
                    'nome' => $row['nome'],
                    'email' => $row['email']
                ];
            }
        }
        return $data;
    }

    public static function getWhere($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM clientes WHERE id = $id";
        $result = $db->query($sql);
        $data = [];

        if ($result && $result->num_rows) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                $data[] = [
                    'id' => $row['id'],
                    'nome' => $row['nome'],
                    'email' => $row['email']
                ];
            }
        }
        return $data;
    }

    public static function insert($nome, $email)
    {
        $db = new Database();
        $sql = "INSERT INTO clientes (nome, email) VALUES ('$nome', '$email')";
        $db->query($sql);

        if ($db->affected_rows) 
        {
            return true;
        }
        return false;
    }

    public static function update($id, $nome, $email)
    {
        $db = new Database();
        $sql = "UPDATE clientes SET nome='$nome', email = '$email' WHERE id = '$id'";
        $db->query($sql);

        if ($db->affected_rows) 
        {
            return true;
        }
        return false;
    }

    public static function delete($id)
    {
        $db = new Database();
        $sql = "DELETE FROM clientes WHERE id = '$id'";
        $db->query($sql);

        if ($db->affected_rows) 
        {
            return true;
        }
        return false;
    }
}
