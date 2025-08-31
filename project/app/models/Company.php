<?php
require_once  "init.php";
class Company extends model
{

    public function insert($name)
    {
        $query = "INSERT INTO `companies`(`name`) VALUES (?)";
        $result = $this->connection->prepare($query);
        $result->bind_param("s", $name);
        $result->execute();
    }
}
