<?php 

    class Database {

        private $hostname;

        private $dbname;

        private $username;

        private $password;

        private $conn;

        public function connect()
        {

            $this -> hostname = "localhost";

            $this -> dbname = "api";

            $this -> username = "root";

            $this -> password = "";

            $this -> conn = new mysqli($this -> hostname, $this -> username, $this -> password, $this -> dbname);

            if($this -> conn -> connect_errno) {
                
                echo "<pre>";
                
                print_r($this -> conn -> connect_error);
                
                echo "</pre>";

                exit;

            } else {

                return $this -> conn;

            }

        }

    }

?>