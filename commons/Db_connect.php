<?php

class Db_connect {

    // Storing static connection object
    protected static $connection;

    // Constructer 
    public function __construct() {
        $this->connect();
    }

    // Establish connection to MySQL
    // Note: may turn to protected
    protected function connect() {    
        // Try and connect to the database
        try { 
            if(!isset(self::$connection)) {
                $db_conf = parse_ini_file('/usr/share/nginx/html/shadowchat/common/db_config.ini'); 
                self::$connection = new PDO("mysql:host={$db_conf['host']};dbname={$db_conf['dbname']}", $db_conf['user'], $db_conf['password']);
            }

            // Persistent Connection without the need of testing !isset(self::$connection)
            // (may be better solution) (may need to close connection manually?)
            # $db_conf = parse_ini_file('/usr/share/nginx/html/shadowchat/common/db_config.ini'); 
            # self::$connection = new PDO('mysql:host=localhost;dbname=shadowchat', $db_conf['user'], $db_conf['password'], array(PDO::ATTR_PERSISTENT => true));

            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return self::$connection;
    }

    public function select_all() {

        // Only use if you don't want to check connection to MySQL
        #$connection = self::$connection;

        // Make sure you are connected too MySQL
        $connection = $this->connect();

        $query_result = $connection->query("SELECT * FROM test1");

        #while ($row = $query_result->fetch(PDO::FETCH_ASSOC)) {
        #    $str = "${row['Date']} ${row['Time']} ${row['User']} ${row['Msg']}\n";
        #    echo $str . "<br/>";
        #    #echo htmlentities($str);
        #}
        while ($row = $query_result->fetch(PDO::FETCH_OBJ)) {
            print_r($row->User);
            echo "<br/>";
            #echo $str . "<br/>";
        }
    }

    public function query($query) {
        // Connect to the database
        $connection = $this -> connect();
        
        // Query the database
        $result = $connection -> query($query);
       
        return $result;
    }

    public function showchat() {
        try {
            $connection = $this->connect();
            $stmt = $connection->prepare("SELECT Date, Time, User, Msg FROM test1 ORDER BY Date, Time"); 
            $stmt->execute();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>${row['Date']}</td>";
                echo "<td>${row['Time']}</td>";
                echo "<td>${row['User']}</td>";
                echo "<td>${row['Msg']}</td>";
                echo "</tr>";
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function kill() {
        self::$connection = null;
        if (!isset(self::$connection)) {
            echo "Connection killed<br/>";
        }
    }

}
