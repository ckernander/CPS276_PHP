<?php
class Db_conn {    
    private $conn;
//I used the example code for this class
    /* THIS CLASS CONNECTS TO THE DATABASE ONLY AND SETS UP THE ATTRIBUTE PARAMETERS */
    public function dbOpen(){
        try {
            $dbHost = 'localhost';
            $dbName = 'ckernander';
            $dbUsr = 'ckernander';
            $dbPass = 'X9n7FlsAqfgIrQq';

            // Establishing the PDO connection
            $this->conn = new PDO('mysql:host=' . $dbHost . ';dbname=' . $dbName, $dbUsr, $dbPass);

            // Setting PDO attributes
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->conn->setAttribute(PDO::ATTR_AUTOCOMMIT, true);
            $this->conn->setAttribute(PDO::MYSQL_ATTR_LOCAL_INFILE, true);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>