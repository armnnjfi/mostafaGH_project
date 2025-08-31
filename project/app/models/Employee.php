<?php
require_once  "init.php";
class Employee extends model
{

    public function insert($user_id,$company_id)
    {
        $query = "INSERT INTO `employees`(`user_id`, `company_id`) VALUES (?,?)";
        $result = $this->connection->prepare($query);
        $result->bind_param("ii", $user_id,$company_id);
        $result->execute();
    }

    
}
