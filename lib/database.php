<?php
class Database
{
    private $host="localhost";
    private $user="root";
    private $pass="";
    private $name="pdo";
    private $pdo;
    public function __construct(){
        if(!isset($this->pdo)){
            try{
                $link=new PDO("mysql:host=".$this->host.";dbname=".$this->name,$this->user,$this->pass);
                $link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $link->exec("SET NAMES utf8");
                $this->pdo=$link;
            }
            catch(PDOException $e){
                die("Failded to connect to database ".$e->getMessage());
            }
        }
    }
    public function select($table,$data=array()){
        $sql="SELECT ";
        $sql.=array_key_exists("select",$data)? $data['select']:"*";
        $sql.=" FROM ".$table;
        if(array_key_exists("where",$data)){
            $i=0;
            $sql.=" where ";
            foreach($data['where'] as $key=>$value){
                $add=($i>0)? " and ":"";
                $sql.="$add"."$key=:$key";
                $i++;
            }
        }
        if(array_key_exists("order_by",$data)){
            $sql.=" order by ".$data['order_by'];
        }
        if(array_key_exists("start",$data) and array_key_exists("limit",$data)){
            $sql.=" limit ".$data['start'].",".$data["limit"];
        }
        else if(!array_key_exists("start",$data) and array_key_exists("limit",$data)){
            $sql.=" limit ".$data['limit'];
        }
        $query=$this->pdo->prepare($sql);
        if(array_key_exists("where",$data)){
            foreach($data['where'] as $key=>$value){
                $query->bindValue(":$key",$value);
            }
        }
        $query->execute();
        if(array_key_exists("return_type",$data)){
            switch($data['return_type']){
                case 'count':
                    $value=$query->rowCount();
                break;
                case 'single':
                $value=$query->fetch(PDO::FETCH_ASSOC);
                break;
                default:
                 $value="";
            }
        }
        else{
            if($query->rowCount()>0){
               $value=$query->fetchAll();
            }
        }
       return  !empty($value)?$value:false;
    }
    public function insert($table,$data){
        if(!empty($data) and is_array($data)){
            $keys=implode(",",array_keys($data));
            $values=":".implode(", :",array_keys($data));
            $sql="insert into ".$table."(".$keys.") values (".$values.")";
            $query=$this->pdo->prepare($sql);
            foreach($data as $key=>$val){
                $query->bindValue(":$key",$val);
            }
            $insert=$query->execute();
            if($insert){
                return "Data added successfully";
            }
            else{
                return "Data not added";
            }
        }
    }
}