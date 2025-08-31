<?php
include 'core/model.php';
class user extends model {
    public function insert($firstname,$username,$password,$email) {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(openssl_random_pseudo_bytes(32));

        $query = "INSERT INTO users (name, username, password, email, token) VALUES (?,?,?,?,?)";
        $result = $this->connection->prepare($query);
        $result->bind_param("sssss",$firstname,$username, $pass_hash, $email, $token);
        $result->execute();

        // Account verification (line commented out because it requires mail server configuration)
        $link = '<a href="http://localhost/mvc/active-link/'.$token.'">Click Me</a>';
        // mail($email, 'Activation link', $link);

        return 'ok';
    }
    public function find_user($username,$password){
        $query = "SELECT * FROM users WHERE username=? AND is_active = 1 limit 0,1" ;
        $result = $this->connection->prepare($query);
        $result->bind_param("s",$username);
        $result->execute();

        $user = $result->get_result()->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            echo "yes";
            return ['response'=>200, 'message'=>$user];
        }
        return ['response'=>403, 'message'=>'Error! Invalid username or password.'];
    }
    public function activate_user($token)
    {
        $query = "SELECT * FROM users WHERE token = ? LIMIT 0, 1";
        $result = $this->connection->prepare($query);
        $result->bind_param('s', $token);
        $result->execute();

        $user = $result->get_result()->fetch_assoc();

        if ($user && isset($user['id']))
        {
            $query = "UPDATE users SET is_active = 1 WHERE id = '".$user['id']."' ";
            $this->connection->query($query);
            return ['response'=>200, 'message'=>$user];
        }
        return ['response'=>403, 'message'=>'Error! Invalid user token.'];
    }

}
?>