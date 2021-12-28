<?php 

    class Student {

        public $name;

        public $email;

        public $mobile;

        public $id;

        private $conn;

        private $table_name;

        public function __construct($db)
        {

            $this -> conn = $db;

            $this -> table_name = "students";

        }

        public function create_data()
        {
            $query = "INSERT INTO " . $this -> table_name . " SET name = ?, email = ?, mobile = ?";

            $obj = $this -> conn -> prepare($query);

            $this -> name = htmlspecialchars(strip_tags($this -> name));

            $this -> email = htmlspecialchars(strip_tags($this -> email));

            $this -> mobile = htmlspecialchars(strip_tags($this -> mobile));

            $obj -> bind_param("ssi", $this -> name, $this -> email, $this -> mobile);

            if($obj -> execute())
            {

                return true;

            }

            return false;

        
        }

        public function get_data() 
        {

            $sql_query = "SELECT * FROM ". $this->table_name;

            $std_obj = $this->conn->prepare($sql_query);
            
            $std_obj -> execute();

            return $std_obj -> get_result();
            
        }

        public function get_student()
        {

            $sql_query = "SELECT * FROM ".$this -> table_name. " WHERE id = ?";

            $obj = $this->conn->prepare($sql_query);

            $obj -> bind_param("i", $this -> id);

            $obj->execute();

            $data = $obj -> get_result();

            return $data -> fetch_assoc();
        }

        public function update_student()
        {
            $update_query = "UPDATE students SET name = ?, email = ?, mobile = ? WHERE id = ?";

            $query_object = $this -> conn -> prepare($update_query);

            $this->name = htmlspecialchars(strip_tags($this->name));

            $this->email = htmlspecialchars(strip_tags($this->email));

            $this->mobile = htmlspecialchars(strip_tags($this->mobile));

            $this->id = htmlspecialchars(strip_tags($this->id));

            $query_object -> bind_param("sssi", $this->name, $this->email, $this->mobile, $this->id);

            if ($query_object -> execute()) {

                return true;

            }

            return false;
        }

        public function delete_student()
        {
            $delete_query = "DELETE from " . $this -> table_name . " WHERE id = ?";

            $delete_obj = $this->conn->prepare($delete_query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $delete_obj -> bind_param("i", $this -> id);

            if ($delete_obj -> execute()) {

                return true;

            } 

            return false;

        }
    }