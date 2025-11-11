<?php
require_once "Validation.php";

class StickyForm extends Validation {
    public $values = [
        "firstName" => "",
        "lastName" => "",
        "email" => "",
        "password1" => "",
        "password2" => ""
    ];

    public $errors = [];
    private $validation;

    public function __construct() {
        $this->validation = new Validation();
    }

    public function validateForm($post) {

        foreach ($this->values as $key => $value) {
            $this->values[$key] = trim($post[$key] ?? '');
        }

        if (!$this->validation->validateName($this->values["firstName"])) {
            $this->errors["firstName"] = "First name can only contain letters, spaces, and apostrophes.";
        }

        if (!$this->validation->validateName($this->values["lastName"])) {
            $this->errors["lastName"] = "Last name can only contain letters, spaces, and apostrophes.";
        }

        if (!$this->validation->validateEmail($this->values["email"])) {
            $this->errors["email"] = "Invalid email format.";
        }

        if (!$this->validation->validatePassword($this->values["password1"])) {
            $this->errors["password1"] = "Password must be 8+ chars, include 1 uppercase, 1 number, and 1 symbol.";
        }

        if ($this->values["password1"] !== $this->values["password2"]) {
            $this->errors["password2"] = "Passwords do not match.";
        }

        return empty($this->errors);
    }
}
?>
