<?php
class SecurityService {
    private $algo = "sha256"; //hash algorithm
    private $hash = true; //false
    private $salt = "QWEGHDBV$&@BGFND";

    public function setCSRFToken() {
        if (empty($_SESSION["csrf-token"])) {
            $_SESSION["csrf-token"] = bin2hex(openssl_random_pseudo_bytes(32));
            // $this->hash = false;
        }
        // echo "session ". $_SESSION["csrf-token"]."<br>";
    }

    public function getCSRFToken() {
        if ($this->hash) {
            return $this->hmac_data($_SESSION["csrf-token"]);
        }

        return $_SESSION["csrf-token"];
    }

    public function hmac_data($data) {
        return hash_hmac($this->algo, $this->salt, $data);
    }

    public function validate_token($token) {
        if (!$_SESSION["csrf-token"]) {
            return var_dump('error csrf token');
        }
        
        if ($this->hash){
            $token_hash = $this->hmac_data($_SESSION["csrf-token"]);
            return hash_equals($token_hash, $token);
        } else {
            return hash_equals($_SESSION["csrf-token"], $token);
        }
    }
}
?>