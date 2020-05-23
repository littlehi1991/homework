<?php
class DB {
    public $servername = "localhost:8889";
    public $username = "root";
    public $dbpw = "Hi0981951456";
    public $dbname = "sweetlife";
        //創建連線

    public function connectDB() {
            try{
                $con = mysqli_connect($this->servername , $this ->username , $this->dbpw ,$this->dbname);
            } catch (Exception $e){
                return false;
            }
            $this->connectDB = $con ;
            return $this;
    }

    public function query($sql){
        if(!is_string($sql)){
            return false;
        }
        if(!$this->connectDB or empty($this->connectDB)){
            return false;
        }
        try {
            return mysqli_query($this->connectDB , $sql);
        } catch (Exception $e){
            return false;
        }
    }
}


