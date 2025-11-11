<?php
class Validation {

    public function validateName($name) {
        return preg_match("/^[A-Za-z' ]+$/", $name);
    }

    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function validatePassword($password) {
        // At least 8 chars, one uppercase, one number, one special character
        return preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password);
    }

}
?>