<?php
class SecurityService {
    private $algo = "sha256"; // hash algorithm
    private $salt = "QWEGHDBV$&@BGFND";

    public function setCSRFToken() {
        if (empty($_SESSION["csrf-token"])) {
            $_SESSION["csrf-token"] = bin2hex(openssl_random_pseudo_bytes(32));
        }
    }

    public function getCSRFToken() {
        return hash_hmac($this->algo, $_SESSION["csrf-token"], $this->salt);
    }

    public function validate_token($token) {
        if (empty($_SESSION["csrf-token"])) return false;
        $token_hash = $this->getCSRFToken();
        return hash_equals($token_hash, $token);
    }
}
?>
