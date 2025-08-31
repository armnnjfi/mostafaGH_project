<?php
include 'core/model.php';
class product extends model{
    public function insert(){}
    public function edit(){}
    public function getProducts(){
        $query = "SELECT * FROM products";
        $result = $this->connection->prepare($query);
        $result->execute();
        
        return $result->get_result();
    }
}
?>