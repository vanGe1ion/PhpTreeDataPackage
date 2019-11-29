<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 19.11.2019
 * Time: 12:30
 */

namespace classes;


use exceptions\PGConnectionRefusedException;

class PgSql
{
    private $host = "";
    private $user = "";
    private $passwd = "";
    private $db = "";
    private $port = "";

    private $connect = null;
    private $result = null;

    public function __construct($host, $login, $passwd, $db, $port = "5432")
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = $login;
        $this->passwd = $passwd;
        $this->db = $db;

        $this->Connect();
    }

    public function __destruct()
    {
        $this->Disconnect();
    }

    private function Connect()
    {
        $this->connect = pg_connect("host={$this->host} port={$this->port} dbname={$this->db} user={$this->user} password={$this->passwd}");
        if(!$this->connect)
            throw new PGConnectionRefusedException("Connection to {$this->host}:{$this->port} was refused.");
    }

    private function Disconnect(){
        pg_close($this->connect);
    }

    public function ConnRefresh() : bool {
        if(pg_connection_status($this->connect) == PGSQL_CONNECTION_OK)
            return true;
        else
            return pg_connection_reset($this->connect);
    }

    public function QueryExecute(String $query)
    {
        if (!$this->connect)
            return false;
        if ($this->result)
            pg_free_result($this->result);

        $res = pg_query($this->connect, $query);
        if($res){
            $this->result = $res;
            return true;
        }
        else
            return $res;
    }

    public function ParamExecute(String $query, array $params){
        if (!$this->connect)
            return false;
        if($this->result)
            pg_free_result($this->result);

        $res = pg_query_params($this->connect, $query, $params);
        if($res){
            $this->result = $res;
            return true;
        }
        else
            return $res;
    }


    public function ToArray($resultType = PGSQL_BOTH, $row = null){
        $resultArray = [];
        if($this->result)
            while($fetch = pg_fetch_array($this->result, $row, $resultType))
                array_push($resultArray, $fetch);
        return $resultArray;
    }

//    public function SelectArray(String $table, array $terms){
//        if (!$this->connect)
//            return false;
//        return pg_select($this->connect,$table, $terms);
//    }
//
//    public function InsertArray(String $table, array $row){
//        if (!$this->connect)
//            return false;
//
//        $res = pg_insert($this->connect,$table, $row);
//        return $res ? true : $res;
//    }
//
//    public function UpdateArray(String $table,array $newdata, array $terms){
//        if (!$this->connect)
//            return false;
//
//        return pg_update($this->connect,$table, $newdata, $terms);
//    }
//
//    public function DeleteArray(String $table, array $terms){
//        if (!$this->connect)
//            return false;
//
//        return pg_delete($this->connect,$table, $terms);
//    }

    public function ResultCursorPosition(int $offset){
        pg_result_seek($this->result, $offset);
    }
}