<?php
require_once  "init.php";
class Users extends model
{

    public function insert($name, $password, $email, $role = "employee")
    {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(openssl_random_pseudo_bytes(32));
        $company_id = 0;
        $query = "INSERT INTO users (company_id, name, email, password, role ,token) VALUES (?,?,?,?,?,?)";
        $result = $this->connection->prepare($query);
        $result->bind_param("isssss", $company_id, $name, $email, $pass_hash, $role, $token);
        $result->execute();

        return 'ok';
    }

    public function find_user($name, $password)
    {
        $query = "SELECT * FROM Users WHERE name = ?";
        $result = $this->connection->prepare($query);
        $result->bind_param("s", $name);
        $result->execute();
        $user = $result->get_result()->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            return ['response' => 200, 'message' => $user];
        }
        return ['response' => 403, 'message' => 'Error! Invalid username or password.'];
    }

    public function getNoCompanyEmployee()
    {
        $query = "SELECT id,name,email,company_id FROM users where company_id = 0";
        $result = $this->connection->prepare($query);
        $result->execute();

        return $result->get_result();
    }

    // public function userPromoteToAdmin($userId)
    // {
    //     $query = "UPDATE users SET  role ='admin' WHERE id = '" . $userId . "'";
    //     $this->connection->query($query);
    // }

    public function userToEmployee($userId,$companyId)
    {
        $query = "UPDATE users SET  company_id = " . $companyId . " WHERE id = '" . $userId . "'";

        $result = $this->connection->prepare($query);
        $result->execute();
    }
}
