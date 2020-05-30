<?php
namespace App;

use PDO;
class Task
{
    public $id=null;
    private $sip;
    private $account;
    private $balance;
    private $error = array();
    public $table = 'seti';

    private function validate()
    {
        foreach (['sip', 'account', 'balance'] as $key) 
        {
            if(empty($this->$key))
            {
                echo $key;
                $this->error[$key] = "Это поле обязательно для ввода";
            }
        }

        if (!empty($this->error))
        {
            return false;
        }

        return true;
    }

    public static function get_pdo()
    {
        $_pdo;
        if (empty($_pdo))
        {
            $_pdo = new PDO('mysql:host=localhost;dbname=test','root',''); 
        }

        return $_pdo;
    }

    public function save_to_db()
    {
        $sql = static::get_pdo()->prepare('INSERT INTO `'.$this->table.'` (`sip`,`account`,`balance`) VALUES (?,?,?);');

        $sql->execute(array($this->sip, $this->account, $this->balance));

        return $sql->rowCount() === 1;
    }

    public function update_db()
    {
        $this->sip = isset($_POST['sip']) ? trim($_POST['sip']) : null;
        $this->account = isset($_POST['account']) ? trim($_POST['account']) : null;
        $this->balance = isset($_POST['balance']) ? trim($_POST['balance']) : null;

        $sql = static::get_pdo()->prepare('UPDATE `'.$this->table.'` SET `sip`= ?, `account`= ?, `balance`= ? where `id`= ? limit 1;');
        $sql->execute(array($this->sip, $this->account, $this->balance, $_GET['id']));

        header('Location: /SHU/test');
    }

    public function validate_two()
    {
        if ($this->sip != trim($_POST['sip']) or $this->account != trim($_POST['account']) or $this->balance != trim($_POST['balance']))
        {
            return true;
        }

        return false;
    }

    public function read_to_db()
    {
        //"<script src = 'test.js'></script>";
        $sql = static::get_pdo()->prepare('SELECT * FROM `' . $this->table . '`;');
        $sql->execute();

        $objects = [];
        $str = '';
        while ($object = $sql->fetchObject(static::class))
        {
            $str .= "<tr><td align='center'>".$object->sip."</td><td align='center'><a href='new_task.php?id=$object->id'>".$object->account."</a></td><td align='center'>".$object->balance."</td><td align='center'><a href='index.php?id=$object->id&del=true'>Удалить</a></td></tr>";
            $objects[] = $object;
        }

        return $str;
    }

    public function read_for_id($gid)
    {
        $sql = static::get_pdo()->prepare('SELECT * FROM `' . $this->table . '` where `id`='.$gid.';');
        $sql->execute();

        $object = $sql->fetchObject(static::class);
        echo $gid;
        $this->id = $gid;
        $this->sip = $object->sip;
        $this->account = $object->account;
        $this->balance = $object->balance;

        $_POST['sip'] = $object->sip;
        $_POST['account'] = $object->account;
        $_POST['balance'] = $object->balance;
    }

    public function insert()
    {
        $this->sip = isset($_POST['sip']) ? trim($_POST['sip']) : null;
        $this->account = isset($_POST['account']) ? trim($_POST['account']) : null;
        $this->balance = isset($_POST['balance']) ? trim($_POST['balance']) : null;

        var_dump($this->duration);

        if ($this->validate())
        {
            $this->save_to_db();
            header('Location: /SHU/test');
        }
    }

    public function del($gid)
    {
        $sql = $this->get_pdo()->prepare('DELETE FROM `'.$this->table.'` WHERE `id`='.$gid.';');
        $sql->execute();
    }
}
